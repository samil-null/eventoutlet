<?php


namespace App\Transformers\Api\App;
use App\Helpers\VideoPathHelper;
use App\Models\Media;
use League\Fractal\TransformerAbstract;

class VideoTransformer extends TransformerAbstract
{
    public function transform(Media $video)
    {
        return [
            'video' => (string) VideoPathHelper::url($video->name),
            'thumb' => (string) VideoPathHelper::thumbUrl($video->name),
            'name' => (string) $video->name,
            'render' => VideoPathHelper::renderUrl($video->name)
        ];
    }
}
