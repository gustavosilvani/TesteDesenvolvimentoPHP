<?php

namespace src\Domain\Interfaces\Repositories;

interface CoordinatesRepositoryInterface
{
    public function save($coordinates);

    public function update($coordinates, $id);

    public function getById($id);

    public function getByColumn($column, $value);

}