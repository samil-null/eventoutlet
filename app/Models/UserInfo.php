<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'users_info';

    protected $guarded = [];

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

    public function speciality()
    {
        return $this->hasOne(Specialty::class,  'id', 'speciality_id')
                    ->withDefault();
    }
}
