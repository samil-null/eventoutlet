<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public const GALLERY_TYPE = 'gallery';

    public const VIDEO_TYPE = 'video';

    const YT_SOURCE = 'youtube';

    const VIMEO_SOURCE = 'vimeo';

    const STORE_SOURCE = 'store';

    protected $table = 'media';

    protected $guarded = [];
}
