<?php

namespace src\Services;

use src\Domain\Entities\Registered;
use src\Domain\Interfaces\Repositories\RegisteredRepositoryInterface;
use src\Domain\Interfaces\Services\RegisteredServiceInterface;

class RegisteredService implements RegisteredServiceInterface
{
    private RegisteredRepositoryInterface $registeredRepository;

    public function __construct(RegisteredRepositoryInterface $registeredRepository)
    {
        return $this->registeredRepository = $registeredRepository;
    }

    public function saveRegistered(Registered $registered)
    {
        return $this->registeredRepository->save($registered);
    }

    public function updateRegistered(Registered $registered, $id)
    {
        $this->registeredRepository->update($registered, $id);
    }

    public function getRegisteredById($id)
    {
        return $this->registeredRepository->getById($id);
    }
}