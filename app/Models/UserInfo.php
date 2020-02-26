<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'users_info';

    protected $guarded = [];

    const NO_GENDER = 0;

    const MALE_GENDER = 1;

    const FEMALE_GENDER = 2;

    public $genders = [
        self::NO_GENDER => [
            'id' => self::NO_GENDER,
            'name' => 'Не выбран'
        ],
        self::MALE_GENDER => [
            'id' => self::MALE_GENDER,
            'name' => 'Мужчина'
        ],
        self::FEMALE_GENDER => [
            'id' => self::FEMALE_GENDER,
            'name' => 'Женщина'
        ]
    ];

    public function getGender($id)
    {
        return $this->genders[$id];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pureWhatsapp()
    {
        if ($this->whatsapp) {
            return preg_replace("/[^0-9]/", '', $this->whatsapp);
        }

        return null;
    }
}
