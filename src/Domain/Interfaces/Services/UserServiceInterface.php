<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\User;

interface UserServiceInterface
{
    public function getUsers(int $count): void;

    public function createUserFromData(array $userData): void;

    public function updateUserFromData(array $userData, User $user): void;
}