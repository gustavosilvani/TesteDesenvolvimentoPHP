<?php

namespace src\Infrastructure;

class GenericRepository
{
    protected \PDO $pdo;
    protected $tableName;

    public function __construct($pdo, $model)
    {
        $this->pdo = $pdo;
        $this->tableName = strtolower(str_replace("src\Domain\Entities\\", "", $model));
    }

    protected function save($data)
    {
        $data = (array)json_decode($data->toJson());

        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });

        $columns = implode(', ', array_map(function ($key) {
            return str_replace('src\Domain\Entities\\', '', $key);
        }, array_keys($filteredData)));

        $values = implode(', ', array_map(function ($value) {
            if (is_object($value)) {
                $value = $value->__toString();
            }
            return $this->pdo->quote($value);
        }, array_values($filteredData)));

        $query = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$values})";
        $statement = $this->pdo->prepare($query);

        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    protected function update($id, $data)
    {
        $columns = '';

        foreach ($data as $key => $value) {
            $columns .= $key . ' = :' . $key . ', ';
        }

        $columns = rtrim($columns, ', ');

        $query = "UPDATE {$this->tableName} SET {$columns} WHERE id = :id";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':id', $id);

        foreach ($data as $key => $value) {
            if ($key === 'pictureId') {
                $statement->bindValue(':' . $key, $value, PDO::PARAM_INT);
            } else {
                $statement->bindValue(':' . $key, $value);
            }
        }

        $statement->execute();

        return $id;
    }

    protected function getById($id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE id = ".$id;

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetch();
    }

    protected function getByColumn($column, $value)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE {$column} = :value LIMIT 1";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':value', $value);
        $statement->execute();

        return $statement->fetch();
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->tableName}";

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }
}