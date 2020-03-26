<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionFieldService extends Model
{
    protected $table = 'additional_fields_services';

    protected $fillable = [
        'speciality_field_id', 'value'
    ];

    public function metaField()
    {
        return $this->hasOne(AdditionFieldSpeciality::class, 'id', 'speciality_field_id');
    }
}
