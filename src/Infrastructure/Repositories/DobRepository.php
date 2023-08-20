<?php

namespace src\Infrastructure\Repositories;

use src\Domain\Entities\Dob;
use src\Domain\Interfaces\Repositories\DobRepositoryInterface;
use src\Infrastructure\GenericRepository;

class DobRepository extends GenericRepository implements DobRepositoryInterface
{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Dob::class);
    }

    public function save($dob)
    {
        return parent::save($dob);
    }

    public function update($dob, $id)
    {
        return parent::update($id, $dob);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function getByColumn($column, $value)
    {
        return parent::getByColumn($column, $value);
    }
}