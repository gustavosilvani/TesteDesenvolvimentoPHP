<?php

namespace src\Domain\Entities;

use src\Domain\BaseEntity;

class Street extends BaseEntity
{
    private $number;
    private $name;

    public function __construct($number, $name)
    {
        $this->number = $number;
        $this->name = $name;
    }

    public function toJson()
    {
        $data = [
            'number' => $this->number,
            'name' => $this->name,
        ];

        return json_encode($data);
    }
}