<?php


namespace App\Utils\Media;


use VideoThumbnail;
use App\Models\Media;
use Illuminate\Support\Str;

class Video
{
    public function load($request)
    {
        $video = $request->file('video');
        $hash = Str::random(21);
        $name = $hash . '.' .$video->getClientOriginalExtension();

        $path = $request->file('video')->storeAs('videos', $name);

        $request->user()->videos()->save(new Media([
            'type' => 'video',
            'type_content' => 'video',
            'name' => $name
        ]));

        VideoThumbnail::createThumbnail(
            storage_path('app/videos/' . $name),
            storage_path('app/videos/thumbs/'),
            $hash . '.jpeg', random_int(4, 20), 1920, 1080);

        return [$path, 'videos/thumbs/' . $hash . '.jpeg'];
    }

    public function take($videos)
    {
        return $videos->map(function ($video) {
            return [
                'video_path' => $video->name,
                'thumb_path' => asset('/videos/thumbs/'. $this->getThumbnailVideo($video->name))
            ];
        });
    }

    private function getThumbnailVideo($filename)
    {
        $fileInfo = new \SplFileInfo($filename);
        $ext = $fileInfo->getExtension();
        $filename = $fileInfo->getBasename($ext);

        return $filename . 'jpeg';
    }
}
