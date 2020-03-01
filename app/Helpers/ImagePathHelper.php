<?php


namespace App\Helpers;


use Illuminate\Support\Str;

class ImagePathHelper
{
    protected const ORIGINAL_FOLDER = 'original';

    protected const IMAGES_FOLDER = 'images';

    protected const RESIZE_FOLDER = 'resize';

    protected const LEN_FILE_NAME = 27;

    public static function publicPath($filename, $folder, $original = true)
    {
        return self::createFullImagePath(self::getFinalPath([$folder], $original), $filename);
    }

    public static function pathBuilder($foldersArray)
    {
        $clearFolders = array_map(function ($folder) {
            return trim($folder, '/');
        }, $foldersArray);

        return '/' . self::IMAGES_FOLDER . '/' . implode('/', $clearFolders) . '/';
    }

    public static function createFullImagePath($path, $filename)
    {
        $createdPath = $path;

        if (is_array($createdPath)) {
            $createdPath = self::pathBuilder($path);
        }

        return $createdPath . $filename;
    }

    public static function generateFileName($ext = 'jpg')
    {
        return Str::random(self::LEN_FILE_NAME) . '.' . $ext;
    }

    public static function getFinalPath(array $folders, bool $original = true)
    {
        $folders[] = $original? self::ORIGINAL_FOLDER : self::RESIZE_FOLDER;;

        return self::pathBuilder($folders);
    }

    public static function getFullStorePath(string $filename, array  $folder, bool $original = true)
    {
        return self::createFullImagePath(self::getFinalPath($folder, $original), $filename);
    }

    public static function getRealStoragePathFile($filename, $folders, $original = true)
    {
        return storage_path('app' . self::getFinalPath($folders, $original) . $filename);
    }
}
