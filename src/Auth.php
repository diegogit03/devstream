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

        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $user_id = $_SESSION['user_id'];

        $model = new User();

        $user = $model->find($user_id);

        if (!$user) {
            return false;
        }

        self::$user = $user;

        return $user;
    }
}
