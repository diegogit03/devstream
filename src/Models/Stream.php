<?php

namespace DevStream\Models;

class Stream extends Model
{
    function __construct()
    {
        $this->tableName = 'streams';
    }
}
