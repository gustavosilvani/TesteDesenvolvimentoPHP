<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Street;
use src\Domain\Interfaces\Repositories\StreetRepositoryInterface;
use src\Infrastructure\GenericRepository;
use src\Infrastructure\Repositories\LocationRepository;

class StreetRepository extends GenericRepository implements StreetRepositoryInterface
{
    private LocationRepository $locationRepository;

    public function __construct($pdo)
    {
        parent::__construct($pdo, Street::class);
        $this->locationRepository = new LocationRepository($pdo);
    }

    public function save($street)
    {
        return parent::save($street);
    }

    public function update($street, $locationId)
    {
        $location = $this->locationRepository->getById($locationId);
        return parent::update($location->streetId, $street);
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