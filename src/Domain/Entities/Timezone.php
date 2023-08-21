<?php

namespace src\Domain\Entities;

use src\Domain\BaseEntity;

class Timezone extends BaseEntity
{
    private $offset;
    private $description;

    public function __construct($offset, $description)
    {
        $this->offset = $offset;
        $this->description = $description;
    }
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'offset' => $this->offset,
            'description' => $this->description,
        ];
    }
}