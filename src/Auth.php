<?php

namespace DevStream;
use DevStream\Models\User;

class Auth
{
    protected static $user = false;

    public static function user()
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

        self::$user = $user;

        return $user;
    }
}
