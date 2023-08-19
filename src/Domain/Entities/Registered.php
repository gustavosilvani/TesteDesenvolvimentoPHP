<?php

namespace src\Domain\Entities;
class Registered
{
    public $date;
    public $age;

    public function __construct($date, $age)
    {
        $this->date = $date;
        $this->age = $age;
    }
}