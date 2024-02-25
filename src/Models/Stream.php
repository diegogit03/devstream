<?php

namespace DevStream\Models;

class Stream extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'streams';
    }

    public function allFromUser($id)
    {
        return $this->query('SELECT * FROM streams WHERE user_id = 1')->fetchAll();
    }
}
