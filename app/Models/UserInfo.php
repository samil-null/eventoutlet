<?php

namespace App\Models;

use App\Helpers\SocialHelper;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    const PERSONAL = 1;
    const ORGANIZATION = 2;

    /**
     * @var array[]
     */
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

    /**
     * @var string
     */
    protected $table = 'users_info';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
                    ->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function speciality()
    {
        return $this->hasOne(Specialty::class,  'id', 'speciality_id')
                    ->withDefault();
    }

    /**
     * @param $value
     */
    public function setSiteAttribute($value)
    {
        $this->attributes['site'] = SocialHelper::pureSiteName($value);
    }

    /**
     * @param $value
     */
    public function setInstagramAttribute($value)
    {
        $this->attributes['instagram'] = SocialHelper::instagramConvertToTag($value);
    }
}
