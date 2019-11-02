<?php

namespace App\Http\Controllers\Api\V1\OAuth;

use Auth;
use App\Users;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginFormRequest;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginFormRequest $request)
    {
        $credentials = $request->only('login', 'password');

        if (!Auth::attempt($credentials)){
            return (response()->json(['unauthorized' => false], 401));
        }

        $ttl = $request->remember ? 2880 : 120;

        Auth::user()->setTtl($ttl);

        $jwt = Auth::user()->token();

        return (response()->json([
            'token_type' => 'Bearer',
            'token' => $jwt['token'],
            'refresh' => $jwt['refresh'],
            'token_expires_at' => Auth::user()->getExpTtl(),
            'refresh_expires_at' => Auth::user()->getRefreshExpTtl(),
        ], 200));
    }
}
