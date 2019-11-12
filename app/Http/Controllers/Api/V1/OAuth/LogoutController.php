<?php

namespace App\Http\Controllers\Api\V1\OAuth;

use Auth;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        Auth::logout();

        return (
            response()->json([
                'You are successfully logged out'
            ])
        );
    }
}
