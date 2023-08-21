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
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date,
            'age' => $this->age,
        ];
    }
}