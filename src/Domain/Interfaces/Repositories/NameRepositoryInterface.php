<?php

namespace src\Domain\Interfaces\Repositories;

interface NameRepositoryInterface
{
    public function save($name);

    public function update($product, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}