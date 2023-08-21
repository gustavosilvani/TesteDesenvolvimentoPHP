<?php

namespace src\Services;

use src\Domain\DTOs\UserDTO;
use src\Domain\Entities\Coordinates;
use src\Domain\Entities\Dob;
use src\Domain\Entities\IdUser;
use src\Domain\Entities\Location;
use src\Domain\Entities\Login;
use src\Domain\Entities\Name;
use src\Domain\Entities\Picture;
use src\Domain\Entities\Registered;
use src\Domain\Entities\Street;
use src\Domain\Entities\Timezone;
use src\Domain\Entities\User;
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

class UserService implements UserServiceInterface
{
    private $apiUrl = "https://randomuser.me/api/";

    private CoordinatesServiceInterface $coordinatesService;
    private DobServiceInterface $dobService;
    private IdUserServiceInterface $idUserService;
    private LocationServiceInterface $locationService;
    private LoginServiceInterface $loginService;
    private NameServiceInterface $nameService;
    private PictureServiceInterface $pictureService;
    private RegisteredServiceInterface $registeredService;
    private StreetServiceInterface $streetService;
    private TimezoneServiceInterface $timezoneService;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        CoordinatesServiceInterface $coordinatesService,
        DobServiceInterface         $dobService,
        IdUserServiceInterface      $idUserService,
        LocationServiceInterface    $locationService,
        LoginServiceInterface       $loginService,
        NameServiceInterface        $nameService,
        PictureServiceInterface     $pictureService,
        RegisteredServiceInterface  $registeredService,
        StreetServiceInterface      $streetService,
        TimezoneServiceInterface    $timezoneService,
        UserRepositoryInterface     $userRepository
    )
    {
        $this->coordinatesService = $coordinatesService;
        $this->dobService = $dobService;
        $this->idUserService = $idUserService;
        $this->locationService = $locationService;
        $this->loginService = $loginService;
        $this->nameService = $nameService;
        $this->pictureService = $pictureService;
        $this->registeredService = $registeredService;
        $this->streetService = $streetService;
        $this->timezoneService = $timezoneService;
        $this->userRepository = $userRepository;
    }

    public function getUsers($count)
    {
        $url = $this->apiUrl . "?results=" . $count;
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if (!$data || !isset($data['results'])) {
            throw new Exception("Invalid API response");
        }

        foreach ($data['results'] as $userData) {
            if (empty($userData['id']['name']))
                continue;
            $userExist = $this->userRepository->getByColumn("email", $userData['email']);
            if ($userExist) {
                $this->updateUserFromData($userData, $userExist);
            } else {
                $this->createUserFromData($userData);
            }
        }

        return $this->returnUsersDto();
    }

    private function returnUsersDto()
    {
        /** @var User[] $users */
        $users = $this->getAll();
        $userDTOs = [];

        /** @var User $user */
        foreach ($users as $user) {
            $name = $this->nameService->getNameById($user->getNameId());
            $locationData = $this->locationService->getLocationById($user->getLocationId());
            $location = new Location(
                $locationData['streetId'],
                $locationData['city'],
                $locationData['state'],
                $locationData['country'],
                $locationData['postcode'],
                $locationData['coordinatesId'],
                $locationData['timezoneId']
            );

            $login = $this->loginService->getLoginById($user->getLoginId());
            $dob = $this->dobService->getDobById($user->getDobId());
            $registered = $this->registeredService->getRegisteredById($user->getRegisteredId());
            $idUser = $this->idUserService->getIdUserById($user->getIdUser());
            $picture = $this->pictureService->getPictureById($user->getPictureId());
            $street = $this->streetService->getStreetById($location->getStreetId());
            $timezone = $this->timezoneService->getTimezoneById($location->getTimeZoneId());
            $coordinates = $this->coordinatesService->getCoordinatesById($location->getCoordinatesId());

            $userDTO = new UserDTO(
                $user->getGender(),
                $user->getEmail(),
                $user->getPhone(),
                $user->getCell(),
                $user->getNat()
            );
            $userDTO->setCoordinates($coordinates);
            $userDTO->setName($name);
            $userDTO->setLocation($locationData);
            $userDTO->setLogin($login);
            $userDTO->setDob($dob);
            $userDTO->setRegistered($registered);
            $userDTO->setUserId($idUser);
            $userDTO->setPicture($picture);
            $userDTO->setStreet($street);
            $userDTO->setTimezone($timezone);
            $userDTOs[] = $userDTO;
        }

        $jsonData = [];
        foreach ($userDTOs as $userDTO) {
            $jsonData[] = $userDTO->toJson();
        }
        return $jsonData;
    }

    private function getAll(): array
    {
        $data = $this->userRepository->getAll();


        $users = [];
        foreach ($data as $userData) {
            $user = new User(
                $userData['gender'],
                $userData['nameId'],
                $userData['locationId'],
                $userData['email'],
                $userData['loginId'],
                $userData['dobId'],
                $userData['registeredId'],
                $userData['phone'],
                $userData['cell'],
                $userData['iduserId'],
                $userData['pictureId'],
                $userData['nat']
            );

            $users[] = $user;
        }

        return $users;
    }

    private function createUserFromData($userData): void
    {
        $name = new Name(
            $userData['name']['title'],
            $userData['name']['first'],
            $userData['name']['last']
        );

        $street = new Street(
            $userData['location']['street']['number'],
            $userData['location']['street']['name']
        );

        $streetId = $this->streetService->saveStreet($street);

        $coordinates = new Coordinates(
            $userData['location']['coordinates']['latitude'],
            $userData['location']['coordinates']['longitude']
        );

        $coordinatesId = $this->coordinatesService->saveCoordinates($coordinates);

        $timezone = new Timezone(
            $userData['location']['timezone']['offset'],
            $userData['location']['timezone']['description']
        );

        $timeZoneId = $this->timezoneService->saveTimezone($timezone);
        $location = new Location(
            $streetId,
            $userData['location']['city'],
            $userData['location']['state'],
            $userData['location']['country'],
            $userData['location']['postcode'],
            $coordinatesId,
            $timeZoneId
        );

        $login = new Login(
            $userData['login']['uuid'],
            $userData['login']['username'],
            $userData['login']['password'],
            $userData['login']['salt'],
            $userData['login']['md5'],
            $userData['login']['sha1'],
            $userData['login']['sha256']
        );

        $dob = new Dob(
            $userData['dob']['date'],
            $userData['dob']['age']
        );

        $registered = new Registered(
            $userData['registered']['date'],
            $userData['registered']['age']
        );

        $id = new IdUser(
            $userData['id']['name'],
            $userData['id']['value']
        );
        $picture = new Picture(
            $userData['picture']['large'],
            $userData['picture']['medium'],
            $userData['picture']['thumbnail']
        );

        $userDTO = new User(
            $userData['gender'],
            $this->nameService->saveName($name),
            $this->locationService->saveLocation($location),
            $userData['email'],
            $this->loginService->saveLogin($login),
            $this->dobService->saveDob($dob),
            $this->registeredService->saveRegistered($registered),
            $userData['phone'],
            $userData['cell'],
            $this->idUserService->saveIdUser($id),
            $this->pictureService->savePicture($picture),
            $userData['nat']
        );

        $this->userRepository->save($userDTO);
    }

    private function updateUserFromData($userData, User $user): void
    {
        $name = new Name(
            $userData['name']['title'],
            $userData['name']['first'],
            $userData['name']['last']
        );

        $street = new Street(
            $userData['location']['street']['number'],
            $userData['location']['street']['name']
        );

        $streetId = $this->streetService->updateStreet($street, $user->getLocationId());

        $coordinates = new Coordinates(
            $userData['location']['coordinates']['latitude'],
            $userData['location']['coordinates']['longitude']
        );

        $coordinatesId = $this->coordinatesService->updateCoordinates($coordinates, $user->getLocationId());

        $timezone = new Timezone(
            $userData['location']['timezone']['offset'],
            $userData['location']['timezone']['description']
        );

        $timeZoneId = $this->timezoneService->updateTimezone($timezone, $user->getLocationId());

        $location = new Location(
            $streetId,
            $userData['location']['city'],
            $userData['location']['state'],
            $userData['location']['country'],
            $userData['location']['postcode'],
            $coordinatesId,
            $timeZoneId
        );

        $login = new Login(
            $userData['login']['uuid'],
            $userData['login']['username'],
            $userData['login']['password'],
            $userData['login']['salt'],
            $userData['login']['md5'],
            $userData['login']['sha1'],
            $userData['login']['sha256']
        );

        $dob = new Dob(
            $userData['dob']['date'],
            $userData['dob']['age']
        );

        $registered = new Registered(
            $userData['registered']['date'],
            $userData['registered']['age']
        );

        $id = new IdUser(
            $userData['id']['name'],
            $userData['id']['value']
        );

        $picture = new Picture(
            $userData['picture']['large'],
            $userData['picture']['medium'],
            $userData['picture']['thumbnail']
        );

        $userDTO = new UserDTO(
            $userData['gender'],
            $this->nameService->updateName($name, $user->getNameId()),
            $this->locationService->updateLocation($location, $user->getLocationId()),
            $userData['email'],
            $this->loginService->updateLogin($login, $user->getLoginId()),
            $this->dobService->updateDob($dob, $user->getDobId()),
            $this->registeredService->updateRegistered($registered, $user->getRegisteredId()),
            $userData['phone'],
            $userData['cell'],
            $this->idUserService->updateIdUser($id, $user->getIdUser()),
            $this->pictureService->updatePicture($picture, $user->getPictureId()),
            $userData['nat']
        );

        $this->userRepository->update($userDTO, $user->getId());
    }
}