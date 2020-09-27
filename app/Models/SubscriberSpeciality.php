<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriberSpeciality extends Model
{
    /**
     * @var string
     */
    protected  $table = 'subscribers_specialties';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function speciality()
    {
        return $this->hasOne(Specialty::class, 'id','specialty_id');
    }
}
