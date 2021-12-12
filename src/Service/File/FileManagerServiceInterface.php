<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 12.12.2021
 * Time: 18:50
 */

namespace App\Service\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileManagerServiceInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public function uploadImage(UploadedFile $uploadedFile):string;

    /**
     * @param string $fileName
     * @return void
     */
    public function removeImage(string $fileName);

}