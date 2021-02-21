<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageManagement
{
    /**
     * Images path for Company logo.
     */
    private $imgPathCompany = '/images/companies';

    /**
     * Create image service
     * 
     * @param UploadedFile $image
     * 
     * @return string $imgPath Image path
     */
    public function createImage($image)
    {
        return $image->store($this->imgPathCompany, 'public');
    }

    /**
     * Update image service
     * 
     * @param string $oldImage
     * @param UploadedFile $newImage
     * 
     * @return string $imgPath Image path
     */
    public function updateImage($oldImage, $newImage)
    {
        if(!empty($oldImage)){
            $this->deleteImage($oldImage);
        }
        
        return $this->createImage($newImage);
    }

    /**
     * Delete image from storage
     * 
     * @param string $image
     * 
     * @return void
     */
    public function deleteImage($image)
    {
        Storage::delete($image);
    }
}