<?php


namespace App\Filters;


use App\Models\Offer;
use EloquentFilter\ModelFilter;

class OfferFilter extends ModelFilter
{
    public function active()
    {
        $this->where('status', Offer::ACTIVE_STATUS);
    }
}
