<?php

namespace App\Models;

use Str;

use EloquentFilter\Filterable;
use App\Filters\UserFilter;
use Hash;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Filterable;
    use Notifiable;
    use Sluggable;

    const NEW_STATUS = 0;
    const ACTIVE_STATUS = 1;
    const WAITING_STATUS = 2;
    const REJECTED_STATUS = 3;
    const BANED_STATUS = 4;

    /**
     * @var string[]
     */
    protected $with = ['info'];

    /**
     * @var array
     */
    public $statuses = [
        self::NEW_STATUS => [
            'name' => 'Новый',
            'public_name' => 'Новый'
        ],

        self::WAITING_STATUS => [
            'name' => 'Ожидает модерации',
            'public_name' => 'На модерации'
        ],
        self::ACTIVE_STATUS => [
            'name' => 'Активен',
            'public_name' => 'Активен'
        ],
        self::REJECTED_STATUS => [
            'name' => 'Отклонен',
            'public_name' => 'Отклонен'
        ],
        self::BANED_STATUS => [
            'name' => 'Заблокирован',
            'public_name' => 'Заблокирован'
        ]
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class,'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activeServices()
    {
        return $this->hasMany(Service::class,'user_id', 'id')
            ->where('status', Service::ACTIVE_STATUS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function offers()
    {
        return $this->hasManyThrough(
            Offer::class,
            Service::class,
            'user_id',
            'service_id',
            'id',
            'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function activeOffers()
    {
        return $this->hasManyThrough(
            Offer::class,
            Service::class,
            'user_id',
            'service_id',
            'id',
            'id'
        )->where('offers.status', Offer::ACTIVE_STATUS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function speciality()
    {
        return $this->hasOneThrough(
            Specialty::class,
            UserInfo::class,
            'user_id',
            'id',
            'id',
            'speciality_id'
        )->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function city()
    {
        return $this->hasOneThrough(
            City::class,
            UserInfo::class,
            'user_id',
            'id',
            'id',
            'city_id'
        )->withDefault();
    }

    /**
     * @param $password
     * @return mixed
     */
    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gallery()
    {
        return $this->hasMany(Media::class,'user_id', 'id')
            ->where('type', Media::GALLERY_TYPE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Media::class,'user_id', 'id')
            ->where('type', Media::VIDEO_TYPE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id')
                    ->withDefault();
    }

    public function viewed()
    {
        $this->info()->increment('views');
    }

    /**
     * @param string $name
     * @return mixed|string
     */
    public function getStatus($name = 'name')
    {
        return $this->statuses[$this->status][$name];
    }

    /**
     * @return string|null
     */
    public function modelFilter()
    {
        return $this->provideFilter(\App\Filters\UserFilter::class);
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::removeEmoji(strip_tags($value));
    }

    /**
     * @inheritDoc
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
