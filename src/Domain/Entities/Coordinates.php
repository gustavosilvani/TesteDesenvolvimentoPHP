<?php

namespace src\Domain\Entities;

use src\Domain\BaseEntity;

class Coordinates extends BaseEntity
{
    private $latitude;
    private $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    public function toJson()
    {
        $data = [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];

        return json_encode($data);
    }
}