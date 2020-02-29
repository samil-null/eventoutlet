<?php


namespace App\Services\Image;


use App\Helpers\ImagePathHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageStoreService
{
    public function execute(UploadedFile $file, $folder, $original = true)
    {
        $path = ImagePathHelper::getFinalPath([$folder], $original);
        $filename = ImagePathHelper::generateFileName($file->getClientOriginalExtension());
        $fullPath = $file->storeAs($path,$filename);

        return [$fullPath, $filename];
    }
}
