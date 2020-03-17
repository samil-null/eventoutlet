<?php


namespace App\Services\Video;


use App\Helpers\VideoPathHelper;
use Illuminate\Support\Facades\Storage;

class VideoRemoveService
{
    public function execute($filename)
    {
        Storage::delete('videos/' . $filename);
        Storage::delete('videos/thumbs/'. VideoPathHelper::getThumbName($filename));
    }
}
