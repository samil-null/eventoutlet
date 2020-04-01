<?php


namespace App\Services\Video;


use App\Models\Media;
use VideoThumbnail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\Helpers\VideoHandler;
use App\Helpers\VideoPathHelper;

class VideoStoreService
{
    public function execute($video, $user)
    {
        $result = VideoHandler::handle($video);

        $user->videos()->create([
            'name' => $result->code,
            'type' => Media::VIDEO_TYPE,
            'source' => $result->source
        ]);

        return [
            VideoPathHelper::renderUrl($result->code, $result->source),
            VideoPathHelper::thumbUrl($result->code, $result->source)
        ];

    }
}
