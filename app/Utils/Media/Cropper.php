<?php


namespace App\Utils\Media;

use ImageOptimizer;
use App\Helpers\ImagePathHelper;
use Illuminate\Support\Facades\Storage;
use Image;

class Cropper
{
    protected const NO_FOUND_IMAGE = 'assets/image-not-found-big.png';

    protected $storage = [
        'gallery' => ['gallery'],
        'avatar' => ['avatar']
    ];

    protected $options = [
        'avatar' => [
            'height' => 200,
            'width' => 200
        ],
        'gallery' => [
            'height' => null,
            'width' => 851
        ],
        'gallery_preview' => [
            'height' => 400,
            'width' => 400
        ],
        'gallery_small' => [
            'height' => 100,
            'width' => 100
        ],
    ];

    protected function prepare($filename, $store, $options, $method)
    {
        $params = $this->getOptions($options);
        $storage = $this->getStorage($store);
        $cropName = $this->createName($filename, $params, $method);
        $cropPath = ImagePathHelper::getFullStorePath($cropName, $storage, false);
        $url = asset($cropPath);

        if (Storage::exists($cropPath)) return $url;

        $image = $this->getImage($filename, $storage);

        if (!$image) return null;

        return [
            'options' => $params,
            'name' => $cropName,
            'image' => $image,
            'storage' => $storage,
            'cropPath' => $cropPath,
            'savePath' => storage_path('app' . $cropPath),
            'url' => $url
        ];

    }

    public function fit($filename, $store, $options)
    {
        $data = $this->prepare($filename, $store, $options, 'fit');

        if (is_string($data)) return $data;
        $image = $data['image'];

        if (!$image) return null;

        $image->fit($data['options']['width'], $data['options']['height'], function ($constraint) {
            $constraint->upsize();
        });
        $image->save($data['savePath']);
        ImageOptimizer::optimize($data['savePath']);
        return $data['url'];
    }

    public function resize($filename, $store, $options)
    {
        $data = $this->prepare($filename, $store, $options, 'resize');

        if (is_string($data)) return $data;
        $image = $data['image'];

        if (!$image) return null;

        $image->resize($data['options']['width'], $data['options']['height'], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save($data['savePath']);
        ImageOptimizer::optimize($data['savePath']);

        return $data['url'];
    }


    public function original($filename, $store)
    {
        $storage = $this->getStorage($store);

        if (is_array($storage)) {
            return asset(ImagePathHelper::getFullStorePath($filename, $storage, true));
        }

        return null;

    }

    /**
     * @param string $storage
     * @return mixed|null
     */
    protected function getStorage(string $storage)
    {
        return isset($this->storage[$storage])?$this->storage[$storage]:null;
    }

    protected function getImage($filename,$storage)
    {
        $path = ImagePathHelper::getRealStoragePathFile($filename, $storage);

        if (is_null($storage) || !file_exists($path)) {
            $path = public_path(self::NO_FOUND_IMAGE);
        };

        try {
            return Image::make($path);
        }catch (\Exception $exception) {
            return false;
        }
    }


    protected function createName($filename, $options, $method) {

        $height = isset($options['height'])? $options['height']: 'no';
        $width = isset($options['width'])? $options['width']: 'no';

        $fileInfo = new \SplFileInfo($filename);
        $ext = $fileInfo->getExtension();
        $filename = trim($fileInfo->getBasename($ext),'.');

        return "{$filename}_{$method}_{$height}x{$width}.$ext";
    }

    /**
     * @param $options
     * @return mixed|null
     */
    protected function getOptions($options)
    {
        if (is_string($options) && isset($this->options[$options])) {
            return $this->options[$options];
        }

        if (is_array($options) && isset($options['height']) && isset($options['width'])) {
            return $options;
        }

        return null;
    }
}
