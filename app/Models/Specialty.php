<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    const DISABLED_STATUS = 0;
    const ACTIVE_STATUS = 1;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'status', 'seo_name', 'plural_name', 'slug'
    ];

    /**
     * @var string[]
     */
    public $statuses = [
        self::DISABLED_STATUS => 'Не активен',
        self::ACTIVE_STATUS => 'Активен'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
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

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->statuses[$this->status];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany(
            AdditionFieldSpeciality::class,
            'speciality_id',
            'id');
    }

    /**
     * @return mixed
     */
    public function active()
    {
        return $this->where('status', self::ACTIVE_STATUS);
    }
}
