<?php

namespace App\Models;

use Str;
use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    const WAITING_STATUS = 0;
    const ACTIVE_STATUS = 1;
    const REJECTED_STATUS = 2;
    const NO_ACTIVE = 3;

    /**
     * @var string[]
     */
    protected $fillable = ['status', 'discount', 'discount_price', 'description'];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var \string[][]
     */
    public  $statuses = [
        self::WAITING_STATUS => [
            'name' => 'Ожидает модерации',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dates()
    {
        return $this->hasMany(OfferDate::class,'offer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
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

    /**
     * @param $key
     * @return string
     */
    public function getStatus($key)
    {
        return $this->statuses[$this->status][$key];
    }

    /**
     * @param $query
     * @param $dateFrom
     * @param $dateTo
     * @return mixed
     */
    public function scopeBetweenDates($query, $dateFrom, $dateTo)
    {
        return $query->whereHas('dates', function ($q) use ($dateFrom, $dateTo) {
            $q->where('date', '>=', $dateFrom)
                ->where('date', '<=', $dateTo);
        });
    }

    /**
     * @param $query
     * @param $condition
     * @param $value
     * @return mixed
     */
    public function scopeBetweenDiscount($query, $condition, $value)
    {
        return $query->where('discount', $condition, $value);
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        return $this->provideFilter(\App\Filters\OfferFilter::class);
    }

    /**
     * @return bool
     */
    public function hasDisabled()
    {
        return !(bool) $this->dates()->count();
    }

    /**
     * @param $value
     */
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::removeEmoji(strip_tags($value));
    }

}
