<?php

namespace src\Services;

use src\Domain\Entities\Street;
use src\Domain\Interfaces\Repositories\StreetRepositoryInterface;
use src\Domain\Interfaces\Services\StreetServiceInterface;

class StreetService implements StreetServiceInterface
{
    private StreetRepositoryInterface $streetRepository;

    public function __construct(StreetRepositoryInterface $streetRepository)
    {
        return $this->streetRepository = $streetRepository;
    }

    public function saveStreet(Street $street)
    {
        return $this->streetRepository->save($street);
    }

    public function updateStreet(Street $street, $locationId)
    {
        $this->streetRepository->update($street, $locationId);
    }

    public function getStreetById($id)
    {
        return $this->streetRepository->getById($id);
    }
}