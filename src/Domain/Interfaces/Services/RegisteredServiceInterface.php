<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Registered;

interface RegisteredServiceInterface
{
    public function saveRegistered(Registered $registered);

    public function updateRegistered(Registered $registered, $id);

    public function getRegisteredById($id);
}