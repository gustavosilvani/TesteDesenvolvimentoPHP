<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Login;

interface LoginServiceInterface
{
    public function saveLogin(Login $login);

    public function updateLogin(Login $login, $id);

    public function getLoginById($id);
}