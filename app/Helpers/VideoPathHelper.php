<?php


namespace App\Helpers;

use App\Models\Media;

class VideoPathHelper
{
    public static function url($name, $store)
    {
        if (Media::YT_SOURCE == $store) {
            return 'http://www.youtube.com/embed/' . $name;
        }
    }

    public static function getThumbName($filename)
    {
        $fileInfo = new \SplFileInfo($filename);
        $ext = $fileInfo->getExtension();
        $filename = $fileInfo->getBasename($ext);

        return $filename . 'jpeg';
    }


    public static function thumbUrl($name, $store)
    {

        if (Media::YT_SOURCE == $store) {
            return 'https://img.youtube.com/vi/' . $name . '/sddefault.jpg';
        } elseif (Media::VIMEO_SOURCE == $store) {

            $apiData = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/$name.php" ) );

            if (is_array( $apiData ) && count( $apiData ) > 0 ) {
                $videoInfo = $apiData[ 0 ];
                return $videoInfo[ 'thumbnail_large' ];
            }
        }
    }

    public static function renderUrl($name, $store)
    {
        if (Media::YT_SOURCE == $store) {
            return 'https://www.youtube.com/embed/' . $name . '?autoplay=1';
        } elseif (Media::VIMEO_SOURCE == $store) {
            return 'https://player.vimeo.com/video/' . $name;
        }
    }

    public static function getRealVideoPath($filename)
    {
        return storage_path('app/videos/' . $filename);
    }
}
