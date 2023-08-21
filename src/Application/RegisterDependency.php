<?php

namespace src\Application;

use DI\Container;
use src\Domain\Interfaces\Repositories\CoordinatesRepositoryInterface;
use src\Domain\Interfaces\Repositories\DobRepositoryInterface;
use src\Domain\Interfaces\Repositories\IdUserRepositoryInterface;
use src\Domain\Interfaces\Repositories\LocationRepositoryInterface;
use src\Domain\Interfaces\Repositories\LoginRepositoryInterface;
use src\Domain\Interfaces\Repositories\NameRepositoryInterface;
use src\Domain\Interfaces\Repositories\PictureRepositoryInterface;
use src\Domain\Interfaces\Repositories\RegisteredRepositoryInterface;
use src\Domain\Interfaces\Repositories\StreetRepositoryInterface;
use src\Domain\Interfaces\Repositories\TimezoneRepositoryInterface;
use src\Domain\Interfaces\Repositories\UserRepositoryInterface;
use src\Domain\Interfaces\Services\CoordinatesServiceInterface;
use src\Domain\Interfaces\Services\DobServiceInterface;
use src\Domain\Interfaces\Services\IdUserServiceInterface;
use src\Domain\Interfaces\Services\LocationServiceInterface;
use src\Domain\Interfaces\Services\LoginServiceInterface;
use src\Domain\Interfaces\Services\NameServiceInterface;
use src\Domain\Interfaces\Services\PictureServiceInterface;
use src\Domain\Interfaces\Services\RegisteredServiceInterface;
use src\Domain\Interfaces\Services\StreetServiceInterface;
use src\Domain\Interfaces\Services\TimezoneServiceInterface;
use src\Domain\Interfaces\Services\UserServiceInterface;
use src\Infrastructure\DatabaseConnection;
use src\Infrastructure\Repositories\CoordinatesRepository;
use src\Infrastructure\Repositories\DobRepository;
use src\Infrastructure\Repositories\IdUserRepository;
use src\Infrastructure\Repositories\LocationRepository;
use src\Infrastructure\Repositories\LoginRepository;
use src\Infrastructure\Repositories\NameRepository;
use src\Infrastructure\Repositories\PictureRepository;
use src\Infrastructure\Repositories\RegisteredRepository;
use src\Infrastructure\Repositories\StreetRepository;
use src\Infrastructure\Repositories\TimezoneRepository;
use src\Infrastructure\Repositories\UserRepository;
use src\Services\CoordinatesService;
use src\Services\DobService;
use src\Services\IdUserService;
use src\Services\LocationService;
use src\Services\LoginService;
use src\Services\NameService;
use src\Services\PictureService;
use src\Services\RegisteredService;
use src\Services\StreetService;
use src\Services\TimezoneService;
use src\Services\UserService;

class RegisterDependency
{
    public function registerDependency(): Container
    {
        $container = new Container();
        $databaseConnection = new DatabaseConnection();
        $pdo = $databaseConnection->getConnection();

        $container->set(CoordinatesRepositoryInterface::class, function ($container) use ($pdo) {
            return new CoordinatesRepository($pdo);
        });

        $container->set(CoordinatesServiceInterface::class, function ($container) {
            $coordinatesRepository = $container->get(CoordinatesRepositoryInterface::class);
            return new CoordinatesService($coordinatesRepository);
        });

        $container->set(DobRepositoryInterface::class, function ($container) use ($pdo) {
            return new DobRepository($pdo);
        });

        $container->set(DobServiceInterface::class, function ($container) {
            $dobRepository = $container->get(DobRepositoryInterface::class);
            return new DobService($dobRepository);
        });

        $container->set(UserRepositoryInterface::class, function ($container) use ($pdo) {
            return new UserRepository($pdo);
        });

        $container->set(UserServiceInterface::class, function ($container) {
            $userRepository = $container->get(UserRepositoryInterface::class);
            return new UserService(
                $container->get(CoordinatesServiceInterface::class),
                $container->get(DobServiceInterface::class),
                $container->get(IdUserServiceInterface::class),
                $container->get(LocationServiceInterface::class),
                $container->get(LoginServiceInterface::class),
                $container->get(NameServiceInterface::class),
                $container->get(PictureServiceInterface::class),
                $container->get(RegisteredServiceInterface::class),
                $container->get(StreetServiceInterface::class),
                $container->get(TimezoneServiceInterface::class),
                $userRepository
            );
        });

        $container->set(PictureRepositoryInterface::class, function ($container) use ($pdo) {
            return new PictureRepository($pdo);
        });

        $container->set(PictureServiceInterface::class, function ($container) {
            $pictureRepository = $container->get(PictureRepositoryInterface::class);
            return new PictureService($pictureRepository);
        });

        $container->set(RegisteredRepositoryInterface::class, function ($container) use ($pdo) {
            return new RegisteredRepository($pdo);
        });

        $container->set(RegisteredServiceInterface::class, function ($container) {
            $registeredRepository = $container->get(RegisteredRepositoryInterface::class);
            return new RegisteredService($registeredRepository);
        });

        $container->set(StreetRepositoryInterface::class, function ($container) use ($pdo) {
            return new StreetRepository($pdo);
        });

        $container->set(StreetServiceInterface::class, function ($container) {
            $streetRepository = $container->get(StreetRepositoryInterface::class);
            return new StreetService($streetRepository);
        });

        $container->set(TimezoneRepositoryInterface::class, function ($container) use ($pdo) {
            return new TimezoneRepository($pdo);
        });

        $container->set(TimezoneServiceInterface::class, function ($container) {
            $timezoneRepository = $container->get(TimezoneRepositoryInterface::class);
            return new TimezoneService($timezoneRepository);
        });

        $container->set(NameRepositoryInterface::class, function ($container) use ($pdo) {
            return new NameRepository($pdo);
        });

        $container->set(NameServiceInterface::class, function ($container) {
            $nameRepository = $container->get(NameRepositoryInterface::class);
            return new NameService($nameRepository);
        });

        $container->set(IdUserRepositoryInterface::class, function ($container) use ($pdo) {
            return new IdUserRepository($pdo);
        });

        $container->set(IdUserServiceInterface::class, function ($container) {
            $idUserRepository = $container->get(IdUserRepositoryInterface::class);
            return new IdUserService($idUserRepository);
        });

        $container->set(LocationRepositoryInterface::class, function ($container) use ($pdo) {
            return new LocationRepository($pdo);
        });

        $container->set(LocationServiceInterface::class, function ($container) {
            $locationRepository = $container->get(LocationRepositoryInterface::class);
            return new LocationService($locationRepository);
        });

        $container->set(LoginRepositoryInterface::class, function ($container) use ($pdo) {
            return new LoginRepository($pdo);
        });

        $container->set(LoginServiceInterface::class, function ($container) {
            $loginRepository = $container->get(LoginRepositoryInterface::class);
            return new LoginService($loginRepository);
        });
        return $container;
    }

}