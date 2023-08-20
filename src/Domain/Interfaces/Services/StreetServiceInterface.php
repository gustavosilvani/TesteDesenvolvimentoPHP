<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Street;

interface StreetServiceInterface
{
    public function saveStreet(Street $street);
    public function updateStreet(Street $street, $locationId);
    public function getStreetById($id);
}