<?php

namespace src\Services;

use src\Domain\DTO\UserDTO;
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

    public function getUsers($count): void
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

    }

    public function createUserFromData($userData): void
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

    public function updateUserFromData($userData, User $user): void
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