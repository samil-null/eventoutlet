<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OfferDate extends Model
{
    /**
     * @var string
     */
    protected $table = 'offers_dates';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return string
     */
    public function dateFormat()
    {
        return Carbon::parse($this->date)->format('Y-m-d');
    }

    /**
     * @param $query
     * @param $from
     * @param $to
     */
    public function scopeBetween($query, $from, $to)
    {
        $query->where('date', '>=', $from)
            ->where('date', '<=', $to);
    }
}
