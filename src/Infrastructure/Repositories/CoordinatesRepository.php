<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Coordinates;
use src\Domain\Interfaces\Repositories\CoordinatesRepositoryInterface;
use src\Infrastructure\GenericRepository;

class CoordinatesRepository extends GenericRepository implements CoordinatesRepositoryInterface
{
    private LocationRepository $locationRepository;

    public function __construct($pdo)
    {
        parent::__construct($pdo, Coordinates::class);
        $this->locationRepository = new LocationRepository($pdo);
    }

    public function save($coordinates)
    {
        return parent::save($coordinates);
    }

    public function update($coordinates, $locationId)
    {
        $location = $this->locationRepository->getById($locationId);
        return parent::update($location->coordinatesId, $coordinates);
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