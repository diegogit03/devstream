<?php

namespace DevStream;
use DevStream\Models\User;

class Auth
{
    protected static User $user;

    public static function user(): User | false
    {
        if (self::$user) {
            return self::$user;
        }

        $user_id = $_COOKIE['user_id'];

        if (!$user_id) {
            return false;
        }

        $model = new User();

        $user = $model->find($user_id);

        if (!$user) {
            return false;
        }

        return $user;
    }
}
