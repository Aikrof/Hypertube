<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUserById(int $id)
    {
        $user = User::select('id', 'login', 'email', 'icon', 'app')->find($id);
        
        if (empty($user)){
            return (response()->json(null, 400));
        }

        $user->icon = UserHelper::getUserIcon($user);

        return (response()->json($user->toArray(), 200));
    }

    public function getUsers()
    {
        $users = User::select('id', 'login', 'email', 'icon', 'app')->get();

        foreach ($users as $user){
            $user->icon = UserHelper::getUserIcon($user);
        }

        return (response()->json($users->toArray(), 200));
    }
}
