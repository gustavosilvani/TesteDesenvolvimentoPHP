<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Login;
use src\Domain\Interfaces\Repositories\LoginRepositoryInterface;
use src\Infrastructure\GenericRepository;

class LoginRepository extends GenericRepository implements LoginRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Login::class);
    }

    public function save($login)
    {
        return parent::save($login);
    }

    public function update($login, $id)
    {
        return parent::update($id, $login);
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