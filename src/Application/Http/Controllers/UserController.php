<?php

namespace src\Application\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\Domain\Interfaces\UserServiceInterface;
use src\Services\UserService;

class UserController
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request, Response $response)
    {
        $users = $this->userService->getUsers(10);
        $response->getBody()->write(json_encode($users));
        return $response->withHeader('Content-Type', 'application/json');
    }
}