<?php

namespace src\Domain\Interfaces\Repositories;

interface RegisteredRepositoryInterface
{
    public function save($registered);

    public function update($registered, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}