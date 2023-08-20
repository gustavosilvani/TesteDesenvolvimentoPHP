<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\IdUser;
use src\Domain\Interfaces\Repositories\IdUserRepositoryInterface;
use src\Infrastructure\GenericRepository;

class IdUserRepository extends GenericRepository implements IdUserRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, IdUser::class);
    }

    public function save($idUser)
    {
        return parent::save($idUser);
    }

    public function update($idUser, $id)
    {
        return parent::update($id, $idUser);
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