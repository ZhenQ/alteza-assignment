<?php

namespace App\Models;

use PDO;
use PDOStatement;

abstract class Model
{
    protected $tableName;
    protected $idCol = 'id';

    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] .'/db/main.db');
        $this->connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    protected function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param int|null $id
     * @return array
     */
    public function get(int $id = null): array
    {
        $sql = "SELECT * FROM $this->tableName ";
        $sql .= $id ? "WHERE $this->idCol = $id" : '';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * @param array $fields
     * @return bool
     */
    public function create(array $fields): bool
    {
        $keys = array_keys($fields);

        $columns = to_pdo_columns($keys);
        $bindings = to_pdo_bindings($keys);

        $sql = "INSERT INTO $this->tableName ($columns) VALUES ($bindings)";

        $stmt = $this->connection->prepare($sql);

        foreach ($fields as $col => &$value) {
            $stmt->bindParam(':'. $col, $value);
        }

        return $stmt->execute();
    }

    /**
     * @param int $id
     * @param array $fields
     * @return bool
     */
    public function update(int $id, array $fields): bool
    {
        $keys = array_keys($fields);

        $toSet = array_reduce($keys, function ($carry, $key) {
            $col = $carry ? ",$key" : $key;
            return "$carry $col=:$key";
        });

        $sql = "UPDATE $this->tableName SET $toSet WHERE id = $id";

        $stmt = $this->connection->prepare($sql);
        foreach ($fields as $col => &$value) {
            $stmt->bindParam(':'. $col, $value);
        }

        return $stmt->execute();
    }

    /**
     * @param string $query
     * @return PDOStatement
     */
    public function query(string $query): PDOStatement
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
