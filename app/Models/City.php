<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public const DISABLED_STATUS = 0;
    public const ACTIVE_STATUS = 1;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'status', 'seo_name'
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
            'city_id',
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
     * @return mixed
     */
    public function active()
    {
        return $this->where('status', City::ACTIVE_STATUS);
    }
}
