<?php

namespace App\Models;

use Str;
use App\Models\AdditionFieldService;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public const WAIT_STATUS = 0;

    public const ACTIVE_STATUS = 1;

    public const REJECTED_STATUS = 2;

    /**
     * @var \string[][]
     */
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

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany(Offer::class,'service_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activeOffers()
    {
      return $this->hasMany(Offer::class,'service_id', 'id')
            ->where('status', Offer::ACTIVE_STATUS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public  function priceOption()
    {
        return $this->hasOne(PriceOption::class, 'id', 'price_option_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany(
            AdditionFieldService::class,'service_id',
            'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @param string $name
     * @return string
     */
    public function getStatus($name = 'name')
    {
        return $this->statuses[$this->status][$name];
    }

    /**
     * @param $value
     */
     public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::removeEmoji(strip_tags($value));
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::removeEmoji(strip_tags($value));
    }
}
