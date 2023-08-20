<?php

namespace src\Services;

use src\Domain\Entities\IdUser;
use src\Domain\Interfaces\Repositories\IdUserRepositoryInterface;
use src\Domain\Interfaces\Services\IdUserServiceInterface;

class IdUserService implements IdUserServiceInterface
{
    private IdUserRepositoryInterface $idUserRepository;

    public function __construct(IdUserRepositoryInterface $idUserRepository)
    {
        $this->idUserRepository = $idUserRepository;
    }

    public function saveIdUser(IdUser $idUser)
    {
        return $this->idUserRepository->save($idUser);
    }

    public function updateIdUser(IdUser $idUser, $id)
    {
        return $this->idUserRepository->update($idUser, $id);
    }

    public function getIdUserById($id)
    {
        return $this->idUserRepository->getById($id);
    }
}