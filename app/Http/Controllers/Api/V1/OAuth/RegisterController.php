<?php

namespace App\Http\Controllers\Api\V1\OAuth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users.
    |
    */

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\Api\Auth\RegisterFormRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterFormRequest $request)
    {
        $user = User::create([
            'login' => $request->login,
            'app' => 'hypertube',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $jwt = $user->setTtl(1440)->token();

        return (response()->json([
            'token_type' => 'Bearer',
            'token' => $jwt['token'],
            'refresh' => $jwt['refresh'],
            'token_expires_at' => $user->getExpTtl(),
            'refresh_expires_at' => $user->getRefreshExpTtl(),
        ], 201));
    }
}
