<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Registered;
use src\Domain\Interfaces\Repositories\RegisteredRepositoryInterface;
use src\Infrastructure\GenericRepository;

class RegisteredRepository extends GenericRepository implements RegisteredRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Registered::class);
    }

    public function save($registered)
    {
        return parent::save($registered);
    }

    public function update($registered, $id)
    {
        return parent::update($id, $registered);
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