<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\User;
use src\Domain\Interfaces\Repositories\UserRepositoryInterface;
use src\Infrastructure\GenericRepository;

class UserRepository extends GenericRepository implements UserRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, User::class);
    }

    public function save($user)
    {
        return parent::save($user);
    }

    public function update($id, $user)
    {
        return parent::update($id, $user);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function getByColumn($column, $value)
    {
        return parent::getByColumn($column, $value);
    }

    public function getAll()
    {
        return parent::getAll();
    }
}