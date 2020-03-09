<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['status', 'discount', 'discount_price', 'description'];

    protected $guarded = [];

    public const WAITING_STATUS = 0;

    public const ACTIVE_STATUS = 1;

    public const REJECTED_STATUS = 2;

    public const NO_ACTIVE = 3;

    public  $statuses = [
        self::WAITING_STATUS => [
            'name' => 'Ожидает',
            'public_name' => 'Ваше предложение отправленно на модерацию'
        ],
        self::ACTIVE_STATUS => [
            'name' => 'Принят',
            'public_name' => 'Ваше предложение подтверждено'
        ],
        self::REJECTED_STATUS => [
            'name' => 'Отклонен',
            'public_name' => 'Ваше предложение откланено'
        ],
        self::NO_ACTIVE => [
            'name' => 'Не активен',
            'public_name' => 'Не активен'
        ]
    ];

    public function dates()
    {
        return $this->hasMany(OfferDate::class,'offer_id', 'id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function user()
    {
        return $this->hasOneThrough(
        User::class,
        Service::class,
        'id',
        'id',
        'service_id',
        'user_id'
        );
    }

    public function calculateDiscountPrice()
    {
        $price = $this->service->price;
        $sale = ($price / 100) * $this->discount;
        $this->discount_price = $price - $sale;
    }

    public function getStatus($key)
    {
        return $this->statuses[$this->status][$key];
    }

    public function scopeBetweenDates($query, $dateFrom, $dateTo)
    {
        return $query->whereHas('dates', function ($q) use ($dateFrom, $dateTo) {
            $q->where('date', '>=', $dateFrom)
                ->where('date', '<=', $dateTo);
        });
    }

    public function scopeBetweenDiscount($query, $condition, $value)
    {
        return $query->where('discount', $condition, $value);
    }

    public function modelFilter()
    {
        return $this->provideFilter(\App\Filters\OfferFilter::class);
    }
}
