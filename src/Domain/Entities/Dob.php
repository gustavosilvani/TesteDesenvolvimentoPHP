<?php

namespace src\Domain\Entities;
class Dob
{
    public $date;
    public $age;

    public function __construct($date, $age)
    {
        $this->date = $date;
        $this->age = $age;
    }
}