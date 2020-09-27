<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionFieldService extends Model
{
    /**
     * @var string
     */
    protected $table = 'additional_fields_services';

    /**
     * @var string[]
     */
    protected $fillable = [
        'speciality_field_id', 'value'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function metaField()
    {
        return $this->hasOne(AdditionFieldSpeciality::class, 'id', 'speciality_field_id');
    }
}
