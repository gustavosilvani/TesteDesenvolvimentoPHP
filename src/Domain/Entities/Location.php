<?php

namespace src\Domain\Entities;

use src\Domain\BaseEntity;

class Location extends BaseEntity
{
    private int $streetId;
    private string $city;
    private string $state;
    private string $country;
    private string $postcode;
    private int $coordinatesId;
    private int $timezoneId;

    public function __construct(
        int    $streetId,
        string $city,
        string $state,
        string $country,
        string $postcode,
        int    $coordinatesId,
        int    $timezoneId
    )
    {
        $this->streetId = $streetId;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->postcode = $postcode;
        $this->coordinatesId = $coordinatesId;
        $this->timezoneId = $timezoneId;
    }

    public function getStreetId(): int
    {
        return $this->streetId;
    }

    public function getCoordinatesId(): int
    {
        return $this->coordinatesId;
    }

    public function getTimezoneId(): int
    {
        return $this->timezoneId;
    }

    public function toJson()
    {
        $data = [
            'streetId' => $this->streetId,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'postcode' => $this->postcode,
            'coordinatesId' => $this->coordinatesId,
            'timezoneId' => $this->timezoneId,
        ];

        return json_encode($data);
    }

    public function toArray()
    {
        $data = [
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'postcode' => $this->postcode,
        ];

        return $data;
    }

}