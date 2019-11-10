<?php

namespace App\Helpers;

use App\User;

class UserHelper
{
    public static function getUserIcon(User $user)
    {
        $http = explode(':', $user->icon)[0];

        if ($http !== 'http' && $http !== 'https'){
            $user_icon = $user->icon === 'default_user_icon.png' ?
                'img/icons/default_user_icon.png' :
                'storage/app/public/' . $user->app . $user->login . $user->icon;
        }
        else
            $user_icon = $user->icon;

        return ($user_icon);
    }
}
