<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\IdUser;

interface IdUserServiceInterface
{
    public function saveIdUser(IdUser $idUser);

    public function updateIdUser(IdUser $idUser, $id);

    public function getIdUserById($id);
}