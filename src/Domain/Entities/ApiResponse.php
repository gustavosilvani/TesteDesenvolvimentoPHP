<?php

namespace src\Domain\Entities;
class ApiResponse
{
    public $results;
    public $info;

    public function __construct($results, $info)
    {
        $this->results = $results;
        $this->info = $info;
    }
}