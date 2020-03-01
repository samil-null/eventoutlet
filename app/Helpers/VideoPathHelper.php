<?php


namespace App\Helpers;


class VideoPathHelper
{
    public static function url($name)
    {
        return asset('videos/' . $name);
    }

    public static function getThumbName($filename)
    {
        $fileInfo = new \SplFileInfo($filename);
        $ext = $fileInfo->getExtension();
        $filename = $fileInfo->getBasename($ext);

        return $filename . 'jpeg';
    }


    public static function thumbUrl($filename)
    {
        return asset('videos/thumbs/' . self::getThumbName($filename));
    }

    public static function renderUrl($name)
    {
        return asset('/app/media/video/render?name=' . $name);
    }

    public static function getRealVideoPath($filename)
    {
        return storage_path('app/videos/' . $filename);
    }
}
