<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\User;

interface UserServiceInterface
{
    public function getUsers(int $count);

}