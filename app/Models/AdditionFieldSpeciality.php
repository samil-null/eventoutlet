<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionFieldSpeciality extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'type'
    ];

    /**
     * @var string
     */
    protected $table = 'additional_fields_specialties';

    public function field()
    {
        //return $this->hasMany(AdditionFieldService::class);
    }
}
