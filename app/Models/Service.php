<?php

namespace App\Models;

use App\Models\AdditionFieldService;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public const WAIT_STATUS = 0;

    public const ACTIVE_STATUS = 1;

    public const REJECTED_STATUS = 2;

    public $statuses = [
        self::WAIT_STATUS => [
            'name' => 'Ожидает модерации',
            'public_name' => 'Ожидает модерации'
        ],
        self::ACTIVE_STATUS => [
            'name' => 'Активна',
            'public_name' => 'Активна'
        ],
        self::REJECTED_STATUS => [
            'name' => 'Отклонена',
            'public_name' => 'Отклонена'
        ]
    ];

    public const LIMIT_RECORD = 6;

    protected $guarded = [];

    public function offers()
    {
        return $this->hasMany(Offer::class,'service_id', 'id');
    }

    public function activeOffers()
    {
      return $this->hasMany(Offer::class,'service_id', 'id')
            ->where('status', Offer::ACTIVE_STATUS);
    }

    public  function priceOption()
    {
        return $this->hasOne(PriceOption::class, 'id', 'price_option_id');
    }

    public function additionalFields()
    {
        return $this->hasManyThrough(
            AdditionFieldSpeciality::class,
            UserInfo::class,
            'user_id',
            'speciality_id',
            'user_id',
            'speciality_id'
        );
    }

    public function fields()
    {
        return $this->hasMany(
            AdditionFieldService::class,'service_id',
            'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStatus($name = 'name')
    {
        return $this->statuses[$this->status][$name];
    }
}
