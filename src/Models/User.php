<?php

namespace DevStream\Models;

class User extends Model
{
    function __construct()
    {
        parent::__construct();
        $this->tableName = 'users';
    }
}
