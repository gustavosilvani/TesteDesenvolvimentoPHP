<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Name;

interface NameServiceInterface
{
    public function saveName(Name $name);

    public function updateName(Name $name, $id);

    public function getNameById($id);
}