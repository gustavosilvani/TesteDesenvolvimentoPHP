<?php

namespace src\Services;

use src\Domain\Entities\Timezone;
use src\Domain\Interfaces\Repositories\TimezoneRepositoryInterface;
use src\Domain\Interfaces\Services\TimezoneServiceInterface;

class TimezoneService implements TimezoneServiceInterface
{
    private TimezoneRepositoryInterface $timezoneRepository;

    public function __construct(TimezoneRepositoryInterface $timezoneRepository)
    {
        return $this->timezoneRepository = $timezoneRepository;
    }

    public function saveTimezone(Timezone $timezone)
    {
        return $this->timezoneRepository->save($timezone);
    }

    public function updateTimezone(Timezone $timezone, $locatonId)
    {
        $this->timezoneRepository->update($timezone, $locatonId);
    }

    public function getTimezoneById($id)
    {
        return $this->timezoneRepository->getById($id);
    }
}