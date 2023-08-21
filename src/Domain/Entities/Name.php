<?php

namespace src\Domain\Entities;
use src\Domain\BaseEntity;

class Name extends BaseEntity
{
    private $title;
    private $first;
    private $last;

    public function __construct($title, $first, $last)
    {
        $this->title = $title;
        $this->first = $first;
        $this->last = $last;
    }
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'first' => $this->first,
            'last' => $this->last,
        ];
    }
}