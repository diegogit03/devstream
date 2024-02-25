<?php

namespace DevStream\Models;

use PDO;

class Connection extends PDO
{
    private static $instances = [];

    public static function getInstance(): Connection
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            $servername = $_ENV['DB_HOST'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];
            $db = $_ENV['DB_NAME'];

            self::$instances[$cls] = new Connection("mysql:host={$servername};dbname={$db}", $user, $pass, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]);
        }

        return self::$instances[$cls];
    }
}