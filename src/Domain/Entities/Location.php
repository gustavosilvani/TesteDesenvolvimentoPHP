<?php

namespace src\Domain\Entities;
class Location
{
    public $street;
    public $city;
    public $state;
    public $country;
    public $postcode;
    public $coordinates;
    public $timezone;

    public function __construct($street, $city, $state, $country, $postcode, $coordinates, $timezone)
    {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->postcode = $postcode;
        $this->coordinates = $coordinates;
        $this->timezone = $timezone;
    }
}