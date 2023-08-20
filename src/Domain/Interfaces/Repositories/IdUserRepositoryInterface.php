<?php

namespace src\Domain\Interfaces\Repositories;

interface IdUserRepositoryInterface
{
    public function save($idUser);

    public function update($idUser, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}