<?php

namespace DevStream\Models;

use PDOStatement;

class Model
{
    protected $tableName = '';

    public Connection $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function all()
    {
        $query = $this->query("SELECT * FROM {$this->tableName}");

        return $query->fetchAll();
    }

    public function find($id)
    {
        $query = $this->query("SELECT * FROM {$this->tableName} WHERE id = ?", [$id]);

        return $query->fetch();
    }

    public function findBy($field, $value)
    {
        $query = $this->query("SELECT * FROM {$this->tableName} WHERE {$field} = ?", [$value]);

        return $query->fetch();
    }

    public function create(array $data)
    {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_map(fn ($val) => '?', array_values($data)));

        $query = $this->query("INSERT INTO {$this->tableName} ({$keys}) VALUES ({$values})", array_values($data));

        return $query->fetch();
    }

    public function query(string $query, array $params = []): PDOStatement | bool
    {
        $query = $this->conn->prepare($query);
        $query->execute($params);
        return $query;
    }
}
