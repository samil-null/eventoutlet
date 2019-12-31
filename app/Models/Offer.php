<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];

    public function offerDates()
    {
        return $this->hasMany(OfferDate::class,'offer_id', 'id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function calculateDiscount()
    {
        $price = $this->service->price;
        $sale = ($price / 100) * $this->discount;
        $this->discount_price = $price - $sale;
        $this->save();
    }
}
