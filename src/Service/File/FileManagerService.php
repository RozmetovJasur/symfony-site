<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 12.12.2021
 * Time: 18:54
 */

namespace App\Service\File;

use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerService implements FileManagerServiceInterface
{
    private string $imageDirectory;

    public function __construct(string $imageDirectory)
    {
        $this->imageDirectory = $imageDirectory;
    }

    public function getImageDirectory(): string
    {
        return $this->imageDirectory;
    }

    public function uploadImage(UploadedFile $uploadedFile): string
    {
        $name = uniqid() . '.' . $uploadedFile->guessExtension();
        try {
            $uploadedFile->move($this->getImageDirectory(), $name);
        } catch (FileException $exception) {
            return $exception;
        }

        return $name;
    }

    public function removeImage(string $fileName)
    {
        $fileSystem = new Filesystem();
        $image = $this->getImageDirectory() . '' . $fileName;
        try {
            $fileSystem->remove($image);
        } catch (IOException $exception) {
            return $exception->getMessage();
        }
    }
}