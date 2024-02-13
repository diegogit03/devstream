<?php

namespace DevStream\Models;

class User extends Model
{
    function __construct()
    {
        $this->tableName = 'users';
    }
}
