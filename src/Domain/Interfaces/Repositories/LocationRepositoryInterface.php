<?php

namespace src\Domain\Interfaces\Repositories;

interface LocationRepositoryInterface
{
    public function save($location);

    public function update($location, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}