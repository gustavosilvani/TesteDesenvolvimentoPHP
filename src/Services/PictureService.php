<?php

namespace src\Services;

use src\Domain\Entities\Picture;
use src\Domain\Interfaces\Repositories\PictureRepositoryInterface;
use src\Domain\Interfaces\Services\PictureServiceInterface;

class PictureService implements PictureServiceInterface
{
    private PictureRepositoryInterface $pictureRepository;

    public function __construct(PictureRepositoryInterface $pictureRepository)
    {
        return $this->pictureRepository = $pictureRepository;
    }

    public function savePicture(Picture $picture)
    {
        return $this->pictureRepository->save($picture);
    }

    public function updatePicture(Picture $picture, $id)
    {
        $this->pictureRepository->update($picture, $id);
    }

    public function getPictureById($id)
    {
        return $this->pictureRepository->getById($id);
    }
}