<?php

namespace src\Domain\Interfaces\Repositories;

interface TimezoneRepositoryInterface
{
    public function save($timezone);

    public function update($timezone, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}