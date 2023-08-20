<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Coordinates;

interface CoordinatesServiceInterface
{
    public function saveCoordinates(Coordinates $coordinates);

    public function updateCoordinates(Coordinates $coordinates, $locationId);

    public function getCoordinatesById($id);
}