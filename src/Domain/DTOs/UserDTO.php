<?php

namespace src\Domain\DTO;

use src\Domain\Entities\Coordinates;
use src\Domain\Entities\Name;
use src\Domain\Entities\Location;
use src\Domain\Entities\Login;
use src\Domain\Entities\Dob;
use src\Domain\Entities\Registered;
use src\Domain\Entities\Picture;

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

    public function __construct(
        string $gender,
        Coordinates $coordinates,
        Name $name,
        Location $location,
        string $email,
        Login $login,
        Dob $dob,
        Registered $registered,
        string $phone,
        string $cell,
        Picture $picture,
        string $nat
    ) {
        $this->gender = $gender;
        $this->coordinates = $coordinates;
        $this->name = $name;
        $this->location = $location;
        $this->email = $email;
        $this->login = $login;
        $this->dob = $dob;
        $this->registered = $registered;
        $this->phone = $phone;
        $this->cell = $cell;
        $this->picture = $picture;
        $this->nat = $nat;
    }
}