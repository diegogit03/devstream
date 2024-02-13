<?php

namespace DevStream\Models;

class Stream extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'streams';
    }
}
