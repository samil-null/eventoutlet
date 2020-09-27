<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceOption extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name'];

    public function getStatus()
    {

    }
}
