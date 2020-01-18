<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionFieldService extends Model
{
    protected $table = 'additional_fields_services';

    protected $fillable = [
        'fields_specialties_id', 'value'
    ];
}
