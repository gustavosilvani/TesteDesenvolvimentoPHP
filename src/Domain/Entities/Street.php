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
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'number' => $this->number,
            'name' => $this->name,
        ];
    }
}