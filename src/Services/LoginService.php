<?php

namespace src\Services;

use src\Domain\Entities\Login;
use src\Domain\Interfaces\Repositories\LoginRepositoryInterface;
use src\Domain\Interfaces\Services\LoginServiceInterface;

class LoginService implements LoginServiceInterface
{
    private LoginRepositoryInterface $loginRepository;

    public function __construct(LoginRepositoryInterface $loginRepository)
    {
        return $this->loginRepository = $loginRepository;
    }

    public function saveLogin(Login $login)
    {
        return $this->loginRepository->save($login);
    }

    public function updateLogin(Login $login, $id)
    {
        $this->loginRepository->update($login, $id);
    }

    public function getLoginById($id)
    {
        return $this->loginRepository->getById($id);
    }
}