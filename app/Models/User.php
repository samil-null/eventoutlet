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

    public const WAITING_STATUS = 0;

    public const ACTIVE_STATUS = 1;

    public const REJECTED_STATUS = 2;

    public const BANNED_STATUS = 3;

    private $statuses = [

    ];
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
        return $this->hasManyThrough(
            Offer::class,
            Service::class,
            'user_id',
            'service_id',
            'id',
            'id'
        );

    }

    public function speciality()
    {
        return $this->hasOneThrough(
            Specialty::class,
            UserInfo::class,
            'user_id',
            'id',
            'id',
            'speciality_id'
        );

    }

    public function city()
    {
        return $this->hasOneThrough(
            City::class,
            UserInfo::class,
            'user_id',
            'id',
            'id',
            'city_id'
        );
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
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    public function viewed()
    {
        $this->info()->increment('views');
    }
}
