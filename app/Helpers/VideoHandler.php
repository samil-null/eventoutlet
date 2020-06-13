<?php

namespace App\Helpers;

use App\Models\Media;

class VideoHandler
{
    public static function handle(string $link)
    {
        if (strripos($link, 'youtube.com') !== false || strripos($link, 'youtu.be') !== false) {
            return self::youtubeHandler($link);
        } elseif (strripos($link, 'vimeo.com') !== false) {
            return self::vimeoHandler($link);
        }
    }

    public static function youtubeHandler($link)
    {
            $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
            $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

            if (preg_match($longUrlRegex, $link, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }

            if (preg_match($shortUrlRegex, $link, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }
            
            return (object) [
                'code'      => $youtube_id,
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

    public static function youtubeShortHandler($link)
    {

    }
}