<?php

namespace src;

use Slim\Factory\AppFactory;
use src\Application\Http\Controllers\UserController;
use src\Application\Http\Views\IndexView;
use src\Services\UserService;

class Application
{
    private $app;

    public function __construct()
    {
        $this->app = AppFactory::create();
        $this->registerRoutes();
    }

    public function run()
    {
        $this->app->run();
    }

    private function registerRoutes()
    {
        $userService = new UserService();
        $userController = new UserController($userService);
        $index = new IndexView();

        $this->app->get('/users', [$userController, 'index']);
        $this->app->get('/', [$index, 'render'] );
    }
}