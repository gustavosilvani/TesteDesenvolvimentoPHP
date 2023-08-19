<?php

namespace src\Domain\Entities;
class Name
{
    public $title;
    public $first;
    public $last;

    public function __construct($title, $first, $last)
    {
        $this->title = $title;
        $this->first = $first;
        $this->last = $last;
    }
}