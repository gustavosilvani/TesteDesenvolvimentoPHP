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
        $localhostOnlyMiddleware = function ($request, $handler) {
            $clientIp = $request->getServerParams()['REMOTE_ADDR'];
            if ($clientIp === '127.0.0.1' || $clientIp === '::1') {
                return $handler->handle($request);
            } else {
                $response = $handler->handle($request);
                $response->getBody()->write('Acesso negado');
                return $response;
            }
        };

        $userService = $this->app->getContainer()->get(UserServiceInterface::class);
        $userController = new UserController($userService);
        $index = new IndexView();

        $this->app->get('/users', [$userController, 'index'])->add($localhostOnlyMiddleware);
        $this->app->get('/', [$index, 'render']);
    }
}
