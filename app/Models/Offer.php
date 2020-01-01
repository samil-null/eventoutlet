<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];

    public const WAITING_STATUS = 0;

    public const APPROVED_STATUS = 1;

    public const REJECTED_STATUS = 2;

    public  $statuses = [
        self::WAITING_STATUS => [
            'name' => 'Ожидает',
            'public_name' => 'Ваше предложение отправленно на модерацию'
        ],
        self::APPROVED_STATUS => [
            'name' => 'Принят',
            'public_name' => 'Ваше предложение подтверждено'
        ],
        self::REJECTED_STATUS => [
            'name' => 'Откланен',
            'public_name' => 'Ваше предложение откланено'
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

    public function calculateDiscountPrice()
    {
        $price = $this->service->price;
        $sale = ($price / 100) * $this->discount;
        $this->discount_price = $price - $sale;
    }
}
