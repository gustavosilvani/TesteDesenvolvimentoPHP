<?php

namespace src\Services;

use src\Domain\Entities\Name;
use src\Domain\Interfaces\Repositories\NameRepositoryInterface;
use src\Domain\Interfaces\Services\NameServiceInterface;

class NameService implements NameServiceInterface
{
    private NameRepositoryInterface $nameRepository;

    public function __construct(NameRepositoryInterface $nameRepository)
    {
        $this->nameRepository = $nameRepository;
    }

    public function saveName(Name $name)
    {
        return $this->nameRepository->save($name);
    }

    public function updateName(Name $name, $id)
    {
        return $this->nameRepository->update($name, $id);
    }

    public function getNameById($id)
    {
        return $this->nameRepository->getById($id);
    }
}