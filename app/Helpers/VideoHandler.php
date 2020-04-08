<?php

namespace App\Helpers;

use App\Models\Media;

class VideoHandler
{
    public static function handle(string $link)
    {
        if (strripos($link, 'youtube.com') !== false) {
            return self::youtubeHandler($link);
        } elseif (strripos($link, 'vimeo.com') !== false) {
            return self::vimeoHandler($link);
        }
    }

    public static function youtubeHandler($link)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $link, $matches);
        
        return (object) [
            'code'      => $matches[1],
            'source'    => Media::YT_SOURCE
        ];
    }

    public static function vimeoHandler($link)
    {
        $link = trim($link, '/');
        $params = explode('/', $link);
        return (object) [
            'code'      => end($params),
            'source'    => Media::VIMEO_SOURCE
        ];
    }
}