<?php


namespace App\Services\Image;

use Webp;
use App\Models\Media;
use App\Helpers\ImagePathHelper;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageStoreService
{
    public function execute(UploadedFile $file, User $user, $folder, $original = true)
    {
    		$path = ImagePathHelper::getFinalPath([$folder], $original);
	        $filename = ImagePathHelper::generateFileName($file->getClientOriginalExtension());
	        $fullPath = $file->storeAs($path,$filename);

	        $user->gallery()->create([
            	'name' => $filename,
            	'type' => Media::GALLERY_TYPE
        	]);

            return [
                'full_path' => asset($fullPath),
                'image'  => $filename
            ];
    }
}
