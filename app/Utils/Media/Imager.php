<?php


namespace App\Utils\Media;


use App\Helpers\ImagePathHelper;
use App\Services\ResizeService;

class Imager
{
    /**
     * @var Cropper
     */
    protected $cropper;

    /**
     * Imager constructor.
     * @param Cropper $cropper
     */
    public function __construct(Cropper $cropper)
    {
        $this->cropper = $cropper;
    }

    public function avatar($path)
    {
        if ($path) {
            return $this->resize->roc($path, 'avatar', 'avatar');
        }

        return asset('/assets/avatars/no-avatar.png');
    }

    public function gallerySmall($filename)
    {
        return $this->cropper->fit($filename, 'gallery' , 'gallery_small');
    }

    public function galleryOriginal($filename)
    {
        return $this->cropper->original($filename, 'gallery');
    }

    public function galleryPreview($filename)
    {
        return $this->cropper->fit($filename, 'gallery' , 'gallery_preview');
    }
}
