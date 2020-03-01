<?php


namespace App\Helpers;


use App\Utils\Media\Cropper;

class AvatarHelper
{
    protected static $cropper;

    protected static $options = [
        'small' => [
            'height' => 50,
            'width' => 50
        ],
        'middle' => [
            'height' => 200,
            'width' => 200
        ],
    ];

    public static function init()
    {
        if (is_null(self::$cropper)) {
            self::$cropper = new Cropper();
        }
    }

    public static function small($filename)
    {
        if (!$filename) {
            return asset('assets/avatars/small.png');
        }

        return self::$cropper->fit($filename, 'avatar', self::$options['small']);
    }

    public static function middle($filename)
    {
        if (!$filename) {
            return asset('assets/avatars/middle.png');
        }

        return self::$cropper->fit($filename, 'avatar', self::$options['middle']);
    }

    public static function original($filename)
    {
        if (!$filename) {
            return asset('assets/avatars/original.png');
        }

        return asset('images/avatar/original/' . $filename);
    }
}
