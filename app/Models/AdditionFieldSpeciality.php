<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionFieldSpeciality extends Model
{
    protected $fillable = [
        'name', 'type'
    ];

    protected $table = 'additional_fields_specialties';

    public function field()
    {
        //return $this->hasMany(AdditionFieldService::class);
    }
}
