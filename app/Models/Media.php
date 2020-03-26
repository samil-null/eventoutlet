<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public const GALLERY_TYPE = 'gallery';

    public const VIDEO_TYPE = 'video';

    protected $table = 'media';

    protected $guarded = [];
}
