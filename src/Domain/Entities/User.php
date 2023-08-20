<?php

namespace src\Domain\Entities;

use src\Domain\BaseEntity;

class User extends BaseEntity
{
    private string $gender;
    private int $nameId;
    private int $locationId;
    private string $email;
    private int $loginId;
    private int $dobId;
    private int $registeredId;
    private string $phone;
    private string $cell;
    private int $iduser;
    private int $pictureId;
    private string $nat;

    public function __construct(
        string $gender,
        int    $nameId,
        int    $locationId,
        string $email,
        int    $loginId,
        int    $dobId,
        int    $registeredId,
        string $phone,
        string $cell,
        int    $iduser,
        int    $pictureId,
        string $nat
    )
    {
        $this->gender = $gender;
        $this->nameId = $nameId;
        $this->locationId = $locationId;
        $this->email = $email;
        $this->loginId = $loginId;
        $this->dobId = $dobId;
        $this->registeredId = $registeredId;
        $this->phone = $phone;
        $this->cell = $cell;
        $this->iduser = $iduser;
        $this->pictureId = $pictureId;
        $this->nat = $nat;
    }

    public function toJson()
    {
        $data = [
            'gender' => $this->gender,
            'nameId' => $this->nameId,
            'locationId' => $this->locationId,
            'email' => $this->email,
            'loginId' => $this->loginId,
            'dobId' => $this->dobId,
            'registeredId' => $this->registeredId,
            'phone' => $this->phone,
            'cell' => $this->cell,
            'iduserId' => $this->iduser,
            'pictureId' => $this->pictureId,
            'nat' => $this->nat,
        ];

        return json_encode($data);
    }

    public function getNameId(): int
    {
        return $this->nameId;
    }

    public function getLocationId(): int
    {
        return $this->locationId;
    }

    public function getLoginId(): int
    {
        return $this->loginId;
    }

    public function getDobId(): int
    {
        return $this->dobId;
    }

    public function getRegisteredId(): int
    {
        return $this->registeredId;
    }

    public function getIdUser(): int
    {
        return $this->iduser;
    }

    public function getPictureId(): int
    {
        return $this->pictureId;
    }

}