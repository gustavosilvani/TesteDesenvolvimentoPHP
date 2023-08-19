<?php

namespace src\Domain\Entities;
class Picture
{
    public $large;
    public $medium;
    public $thumbnail;

    public function __construct($large, $medium, $thumbnail)
    {
        $this->large = $large;
        $this->medium = $medium;
        $this->thumbnail = $thumbnail;
    }
}