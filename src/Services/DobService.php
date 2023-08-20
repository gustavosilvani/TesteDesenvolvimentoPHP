<?php

namespace src\Services;

use src\Domain\Entities\Dob;
use src\Domain\Interfaces\Repositories\DobRepositoryInterface;
use src\Domain\Interfaces\Services\DobServiceInterface;

class DobService implements DobServiceInterface
{
    private DobRepositoryInterface $dobRepository;

    public function __construct(DobRepositoryInterface $dobRepository)
    {
        return $this->dobRepository = $dobRepository;
    }

    public function saveDob(Dob $dob)
    {
        return $this->dobRepository->save($dob);
    }

    public function updateDob(Dob $dob, $id)
    {
        $this->dobRepository->update($dob, $id);
    }

    public function getDobById($id)
    {
        return $this->dobRepository->getById($id);
    }
}