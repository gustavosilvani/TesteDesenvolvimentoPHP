<?php

namespace src\Domain\Interfaces\Repositories;

interface DobRepositoryInterface
{
    public function save($dob);

    public function update($dob, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}