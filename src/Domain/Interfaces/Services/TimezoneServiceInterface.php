<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Timezone;

interface TimezoneServiceInterface
{
    public function saveTimezone(Timezone $timezone);

    public function updateTimezone(Timezone $timezone, $locatonId);

    public function getTimezoneById($id);
}