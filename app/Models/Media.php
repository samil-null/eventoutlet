<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    const GALLERY_TYPE = 'gallery';
    const VIDEO_TYPE = 'video';
    const YT_SOURCE = 'youtube';
    const VIMEO_SOURCE = 'vimeo';
    const STORE_SOURCE = 'store';

    /**
     * @var string
     */
    protected $table = 'media';

    /**
     * @var array
     */
    protected $guarded = [];
}
