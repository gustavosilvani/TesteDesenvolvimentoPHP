<?php

namespace src\Domain\Entities;
use src\Domain\BaseEntity;

class IdUser extends BaseEntity
{
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function toJson()
    {
        $data = [
            'name' => $this->name,
            'value' => $this->value,
        ];

        return json_encode($data);
    }
}