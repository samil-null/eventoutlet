<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
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
            'city_id',
            'id',
            'id',
            'user_id'
        );
    }

    public function getStatus()
    {
        return $this->statuses[$this->status];
    }

    public function active()
    {
        return $this->where('status', City::ACTIVE_STATUS);
    }
}
