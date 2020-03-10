<?php


namespace App\Services\Image;


use App\Models\Media;
use App\Helpers\ImagePathHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageStoreService
{
    public function execute(array $files, $user, $folder, $original = true)
    {
    	$result = [];

    	foreach ($files as $file) {
    		$path = ImagePathHelper::getFinalPath([$folder], $original);
	        $filename = ImagePathHelper::generateFileName($file->getClientOriginalExtension());
	        $fullPath = $file->storeAs($path,$filename);

	        $result[] = [
	        	'full_path' => asset($fullPath),
	        	'image'  => $filename
	        ];

	        $user->gallery()->create([
            	'name' => $filename,
            	'type' => Media::GALLERY_TYPE
        	]);

    	}
        
        return $result;
    }
}
