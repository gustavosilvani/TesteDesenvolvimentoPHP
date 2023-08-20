<?php

namespace src\Domain\Interfaces\Repositories;


interface UserRepositoryInterface
{
    public function save($user);

    public function update($user, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}