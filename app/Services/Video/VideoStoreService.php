<?php


namespace App\Services\Video;


use App\Models\Media;
use VideoThumbnail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class VideoStoreService
{
    public function execute(UploadedFile $video, $user)
    {
        $hash = Str::random(21);
        $name = $hash . '.' .$video->getClientOriginalExtension();
        $path = $video->storeAs('videos', $name);

        VideoThumbnail::createThumbnail(
            storage_path('app/videos/' . $name),
            storage_path('app/videos/thumbs/'),
            $hash . '.jpeg',
            random_int(10, 15), 1920, 1080);

        $user->videos()->create([
            'name' => $name,
            'type' => Media::VIDEO_TYPE
        ]);

        return [$path, 'videos/thumbs/' . $hash . '.jpeg'];
    }
}
