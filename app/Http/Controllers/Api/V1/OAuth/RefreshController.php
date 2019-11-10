<?php

namespace App\Http\Controllers\Api\V1\OAuth;

use Auth;
use App\Http\Controllers\Controller;

class RefreshController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {

        if (! $jwt = Auth::refresh()){
            return (
                response()->json('JWT token mismatch.', 419)
            );
        }

        return (
            response()->json([
                'token_type' => 'Bearer',
                'token' => $jwt['token'],
                'refresh' => $jwt['refresh'],
                'token_expires_at' => Auth::user()->getExpTtl(),
                'refresh_expires_at' => Auth::user()->getRefreshExpTtl(),
            ], 200)
        );
    }
}
