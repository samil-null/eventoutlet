<?php

namespace App\Models;

use App\Helpers\SocialHelper;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    const PERSONAL = 1;

    const ORGANIZATION = 2;

    public $user_types = [
        [
            'name' => 'Физ. лицо',
            'id' => self::PERSONAL
        ],
        [
            'name' => 'Компания',
            'id' => self::ORGANIZATION
        ]
    ];

    protected $table = 'users_info';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
                    ->withDefault();
    }

    public function speciality()
    {
        return $this->hasOne(Specialty::class,  'id', 'speciality_id')
                    ->withDefault();
    }

    public function setSiteAttribute($value)
    {
        $this->attributes['site'] = SocialHelper::pureSiteName($value);
    }

    public function setInstagramAttribute($value)
    {
        $this->attributes['instagram'] = SocialHelper::instagramConvertToTag($value);
    }
}
