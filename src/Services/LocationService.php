<?php

namespace src\Services;

use src\Domain\Entities\Location;
use src\Domain\Interfaces\Repositories\LocationRepositoryInterface;
use src\Domain\Interfaces\Services\LocationServiceInterface;

class LocationService implements LocationServiceInterface
{
    private LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        return $this->locationRepository = $locationRepository;
    }

    public function saveLocation(Location $location)
    {
        return $this->locationRepository->save($location);
    }

    public function updateLocation(Location $location, $id)
    {
        $this->locationRepository->update($location, $id);
    }

    public function getLocationById($id)
    {
        return $this->locationRepository->getById($id);
    }
}