<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    public const TEXT_FIELD = 'text';

    public const TEXT_AREA_FIELD = 'textarea';

    public $options = [
        self::TEXT_FIELD => 'Текст',
        self::TEXT_AREA_FIELD => 'Текстовая область'
    ];

    protected $fillable = [
        'name', 'status'
    ];
    public const DISABLED_STATUS = 0;

    public const ACTIVE_STATUS = 1;

    public $statuses = [
        self::DISABLED_STATUS => 'Не активен',
        self::ACTIVE_STATUS => 'Активен'
    ];

    public function users()
    {
        return $this->hasOneThrough(
        User::class,
        UserInfo::class,
        'speciality_id',
        'id',
        'id',
        'user_id'
        );
    }

    public function getStatus()
    {
        return $this->statuses[$this->status];
    }

    public function fields()
    {
        return $this->hasMany(AdditionFieldSpeciality::class,'speciality_id', 'id');
    }
}
