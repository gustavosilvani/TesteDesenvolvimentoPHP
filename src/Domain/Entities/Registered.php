<?php

namespace src\Domain\Entities;

use src\Domain\BaseEntity;

class Registered extends BaseEntity
{
    private $date;
    private $age;

    public function __construct($date, $age)
    {
        $this->date = $date;
        $this->age = $age;
    }

    public function toJson()
    {
        $data = [
            'date' => $this->date,
            'age' => $this->age,
        ];

        return json_encode($data);
    }
}