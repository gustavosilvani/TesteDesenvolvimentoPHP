<?php

namespace src\Domain\Interfaces\Repositories;


interface LoginRepositoryInterface
{
    public function save($login);

    public function update($login, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}