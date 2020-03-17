<?php


namespace App\Transformers\Api\App;


use App\Helpers\ImagePathHelper;
use App\Models\Media;
use League\Fractal\TransformerAbstract;

class GalleryTransformer extends TransformerAbstract
{
    public function transform(Media $image)
    {
        return [
            'image' => $image->name,
            'full_path' => ImagePathHelper::publicPath($image->name, 'gallery')
        ];
    }
}
