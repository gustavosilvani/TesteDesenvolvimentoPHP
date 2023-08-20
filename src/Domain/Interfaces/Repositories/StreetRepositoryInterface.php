<?php

namespace src\Domain\Interfaces\Repositories;

use src\Domain\Entities\Street;

interface StreetRepositoryInterface
{
    public function save($street);

    public function update($street, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}