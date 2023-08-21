<?php

namespace src\Domain\DTOs;

use src\Domain\Entities\Coordinates;
use src\Domain\Entities\Name;
use src\Domain\Entities\Location;
use src\Domain\Entities\Login;
use src\Domain\Entities\Dob;
use src\Domain\Entities\Registered;
use src\Domain\Entities\Picture;
use src\Domain\Entities\IdUser;
use src\Domain\Entities\Street;
use src\Domain\Entities\Timezone;

class UserDTO
{
    public string $gender;
    public Coordinates $coordinates;
    public Name $name;
    public Location $location;
    public string $email;
    public Login $login;
    public Dob $dob;
    public Registered $registered;
    public string $phone;
    public string $cell;
    public Picture $picture;
    public string $nat;
    public IdUser $userId;
    public Street $street;
    public Timezone $timezone;

    public function __construct(
        string      $gender,
        string      $email,
        string      $phone,
        string      $cell,
        string      $nat
    )
    {
        $this->gender = $gender;
        $this->email = $email;
        $this->phone = $phone;
        $this->cell = $cell;
        $this->nat = $nat;
    }

    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = new Coordinates(
            $coordinates['latitude'],
            $coordinates['longitude']
        );
    }

    public function setName(array $name): void
    {
        $this->name = new Name(
            $name['title'],
            $name['first'],
            $name['last']
        );
    }

    public function setLocation(array $location): void
    {
        $this->location = new Location(
            $location['streetId'],
            $location['city'],
            $location['state'],
            $location['country'],
            $location['postcode'],
            $location['coordinatesId'],
            $location['timezoneId']
        );
    }

    public function setRegistered(array $registered): void
    {
        $this->registered = new Registered(
            $registered['date'],
            $registered['age']
        );
    }

    public function setPicture(array $picture): void
    {
        $this->picture = new Picture(
            $picture['large'],
            $picture['medium'],
            $picture['thumbnail']
        );
    }

    public function setUserId(array $userId): void
    {
        $this->userId = new IdUser(
            $userId['name'],
            $userId['value']
        );
    }

    public function setStreet(array $street): void
    {
        $this->street = new Street(
            $street['number'],
            $street['name']
        );
    }

    public function setTimezone(array $timezone): void
    {
        $this->timezone = new Timezone(
            $timezone['offset'],
            $timezone['description']
        );
    }

    public function setLogin(array $login): void
    {
        $this->login = new Login(
            $login['uuid'],
            $login['username'],
            $login['password'],
            $login['salt'],
            $login['md5'],
            $login['sha1'],
            $login['sha256']
        );
    }

    public function setDob(array $dob): void
    {
        $this->dob = new Dob(
            $dob['date'],
            $dob['age']
        );
    }

    public function toJson(): string
    {
        $data = [
            'gender' => $this->gender,
            'coordinates' => $this->coordinates->toArray(),
            'name' => $this->name->toArray(),
            'location' => $this->location->toArray(),
            'email' => $this->email,
            'login' => $this->login->toArray(),
            'dob' => $this->dob->toArray(),
            'registered' => $this->registered->toArray(),
            'phone' => $this->phone,
            'cell' => $this->cell,
            'picture' => $this->picture->toArray(),
            'nat' => $this->nat,
            'userId' => $this->userId->toArray(),
            'street' => $this->street->toArray(),
            'timezone' => $this->timezone->toArray(),
        ];

        return json_encode($data);
    }
}