<?php

namespace src\Domain\Entities;
class Street
{
    public $number;
    public $name;

    public function __construct($number, $name)
    {
        $this->number = $number;
        $this->name = $name;
    }
}