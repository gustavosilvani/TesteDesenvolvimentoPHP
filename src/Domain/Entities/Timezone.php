<?php

namespace src\Domain\Entities;
class Timezone
{
    public $offset;
    public $description;

    public function __construct($offset, $description)
    {
        $this->offset = $offset;
        $this->description = $description;
    }
}