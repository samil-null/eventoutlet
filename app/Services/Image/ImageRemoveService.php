<?php


namespace App\Services\Image;


use App\Helpers\ImagePathHelper;
use Illuminate\Support\Facades\Storage;

class ImageRemoveService
{
    protected const BASE_PATH = '/images/';

    public function execute($filename, $folder)
    {
        $path = ImagePathHelper::createFullImagePath(ImagePathHelper::getFinalPath([$folder], true), $filename);
        Storage::delete($path);
    }
}
