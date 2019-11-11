<?php

namespace App\Http\Controllers\Api\V1\OAuth;

use Auth;
use App\User;
use Exception;
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
            $jwt = $user->setTtl(2880)->token();
        } catch (Exception $exception) {
            abort(404);
        }

        return redirect()->back()
            ->withCookie(
                $this->setCookie('Authorization', $user, $jwt)
            )
            ->withCookie(
                $this->setCookie('Authenticate', $user, $jwt)
            );
    }

    protected function setCookie(String $name, User $user, array $jwt)
    {
        $value = $name === 'Authorization' ?
            'Bearer ' . $jwt['token'] : $jwt['refresh'];

        return (
            cookie(
                $name,
                $value,
                $user->getRefreshTtl(),
                '/',
                null,
                false,
                false
            )
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
