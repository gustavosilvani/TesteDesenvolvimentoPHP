<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Location;
use src\Domain\Interfaces\Repositories\LocationRepositoryInterface;
use src\Infrastructure\GenericRepository;

class LocationRepository extends GenericRepository implements LocationRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Location::class);
    }

    public function save($location)
    {
        return parent::save($location);
    }

    public function update($location, $id)
    {
        return parent::update($id, $location);
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