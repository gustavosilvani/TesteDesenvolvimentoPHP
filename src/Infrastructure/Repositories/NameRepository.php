<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Name;
use src\Domain\Interfaces\Repositories\NameRepositoryInterface;
use src\Infrastructure\GenericRepository;

class NameRepository extends GenericRepository implements NameRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Name::class);
    }

    public function save($name)
    {
        return parent::save($name);
    }

    public function update($name, $id)
    {
        return parent::update($id, $name);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function getByColumn($column, $value)
    {
        return parent::getByColumn($column, $value);
    }
}