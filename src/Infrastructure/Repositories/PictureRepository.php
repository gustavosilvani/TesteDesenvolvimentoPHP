<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Picture;
use src\Domain\Interfaces\Repositories\PictureRepositoryInterface;
use src\Infrastructure\GenericRepository;

class PictureRepository extends GenericRepository implements PictureRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Picture::class);
    }

    public function save($picture)
    {
        return parent::save($picture);
    }

    public function update($picture, $id)
    {
        return parent::update($id, $picture);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function getByColumn($column, $value)
    {
        return parent::getByColumn($column, $value);
    }
}