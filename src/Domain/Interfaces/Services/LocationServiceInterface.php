<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Location;

interface LocationServiceInterface
{
    public function saveLocation(Location $location);

    public function updateLocation(Location $location, $id);

    public function getLocationById($id);
}