<?php

namespace App\Http\Controllers\Api\V1\OAuth;

use App\User;
use Auth;
use Exception;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($app)
    {
        try {
            return Socialite::driver($app)->stateless()->redirect();
        } catch (Exception $exception) {
            abort(404);
        }
    }

    public function providerCallback(Request $request, $app)
    {
        try {
            $app_data = Socialite::driver($app)->stateless()->user();

            $user = $this->findOrCreateUser($app_data, $app);
            $jwt = $user->token();
        } catch (Exception $exception) {
            abort(404);
        }

        return (
            response()->json([
                'token_type' => 'Bearer',
                'token' => $jwt['token'],
                'refresh' => $jwt['refresh'],
                'expires_at' => $user->getTtl(),
            ])
        );
    }

    protected function findOrCreateUser($app_data, $app)
    {
        $credentials = [
            'login' => $app_data->user['login'],
            'app' => $app,
            'email' => $app_data->user['email'],
            'icon' => $app_data->user['avatar_url'] ?? $app_data->user['image_url'],
            'password' => $app . $app_data->user['id']
        ];

        return (
            User::firstOrCreate($credentials)
        );
    }
}
