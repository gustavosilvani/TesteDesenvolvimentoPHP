<?php

namespace src\Domain\Interfaces\Repositories;

interface PictureRepositoryInterface
{
    public function save($picture);

    public function update($picture, $id);

    public function getById($id);

    public function getByColumn($column, $value);
}