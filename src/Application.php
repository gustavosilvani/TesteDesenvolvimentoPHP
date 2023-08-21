<?php

namespace src;

use Slim\Factory\AppFactory;
use src\Application\Http\Controllers\UserController;
use src\Application\Http\Views\IndexView;
use src\Application\RegisterDependency;
use src\Domain\Interfaces\Services\UserServiceInterface;


class Application
{
    private $app;

    public function __construct()
    {
        $register = new RegisterDependency();
        AppFactory::setContainer($register->registerDependency());
        $this->app = AppFactory::create();
        $this->registerRoutes();
    }

    public function run()
    {
        $this->app->run();
    }


    private function registerRoutes()
    {
        $userService = $this->app->getContainer()->get(UserServiceInterface::class);
        $userController = new UserController($userService);
        $index = new IndexView();

        $this->app->get('/users', [$userController, 'index']);
        $this->app->get('/', [$index, 'render']);
    }
}