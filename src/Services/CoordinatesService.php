<?php

namespace src\Services;

use src\Domain\Entities\Coordinates;
use src\Domain\Interfaces\Repositories\CoordinatesRepositoryInterface;
use src\Domain\Interfaces\Services\CoordinatesServiceInterface;

class CoordinatesService implements CoordinatesServiceInterface
{
    private CoordinatesRepositoryInterface $coordinatesRepository;

    public function __construct(CoordinatesRepositoryInterface $coordinatesRepository)
    {
        $this->coordinatesRepository = $coordinatesRepository;
    }

    public function saveCoordinates(Coordinates $coordinates)
    {
        return $this->coordinatesRepository->save($coordinates);
    }

    public function updateCoordinates(Coordinates $coordinates, $locationId)
    {
        return $this->coordinatesRepository->update($coordinates, $locationId);
    }

    public function getCoordinatesById($id)
    {
        return $this->coordinatesRepository->getById($id);
    }
}