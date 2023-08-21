<?php

namespace src\Domain\Entities;
use src\Domain\BaseEntity;

class Picture extends BaseEntity
{
    private $large;
    private $medium;
    private $thumbnail;
    private $userId;

    public function __construct($large, $medium, $thumbnail)
    {
        $this->large = $large;
        $this->medium = $medium;
        $this->thumbnail = $thumbnail;
    }
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'large' => $this->large,
            'medium' => $this->medium,
            'thumbnail' => $this->thumbnail,
        ];
    }
}