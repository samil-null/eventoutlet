<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OfferDate extends Model
{
    protected $table = 'offers_dates';

    protected $guarded = [];

    public function dateFormat()
    {
        return Carbon::parse($this->date)->format('Y-m-d');
    }

    public function scopeBetween($query, $from, $to)
    {
        $query->where('date', '>=', $from)
            ->where('date', '<=', $to);
    }
}
