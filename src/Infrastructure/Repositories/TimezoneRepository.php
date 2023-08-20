<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\TimeZone;
use src\Domain\Interfaces\Repositories\TimeZoneRepositoryInterface;
use src\Infrastructure\GenericRepository;

class TimezoneRepository extends GenericRepository implements TimeZoneRepositoryInterface
{
    private LocationRepository $locationRepository;

    public function __construct($pdo)
    {
        parent::__construct($pdo, TimeZone::class);
        $this->locationRepository = new LocationRepository($pdo);
    }

    public function save($timeZone)
    {
        return parent::save($timeZone);
    }

    public function update($timezone, $locationId)
    {
        $location = $this->locationRepository->getById($locationId);
        return parent::update($location->timezoneId, $timezone);
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