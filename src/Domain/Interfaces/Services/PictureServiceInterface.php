<?php

namespace src\Domain\Interfaces\Services;

use src\Domain\Entities\Picture;

interface PictureServiceInterface
{
    public function savePicture(Picture $picture);

    public function updatePicture(Picture $picture, $id);

    public function getPictureById($id);
}