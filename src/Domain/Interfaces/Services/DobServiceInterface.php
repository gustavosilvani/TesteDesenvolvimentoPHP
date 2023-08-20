<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Dob;

interface DobServiceInterface
{
    public function saveDob(Dob $dob);

    public function updateDob(Dob $dob, $id);

    public function getDobById($id);
}