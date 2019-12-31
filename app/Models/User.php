<?php

namespace App\Models;

use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'about_me', 'specialty', 'email', 'password', 'speciality_id', 'avatar'
//    ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function services()
    {
        return $this->hasMany(Service::class,'user_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class,'user_id', 'id');
    }

    public function speciality()
    {
        return $this->hasOne(Specialty::class, 'id', 'speciality_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function offersDates()
    {
        return $this->hasManyThrough(
            OfferDate::class,
            Offer::class,
            'user_id',
            'offer_id',
            'id');
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function gallery()
    {
        return $this->hasMany(Media::class,'user_id', 'id')
                    ->where(['type' => 'image', 'type_content' => 'gallery']);
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'id', 'user_id');
    }
}
