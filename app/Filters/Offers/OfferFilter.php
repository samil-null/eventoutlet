<?php


namespace App\Filters\Offers;


use App\Helpers\DateHelper;
use Illuminate\Http\Request;

class OfferFilter extends BaseOfferFilter implements OfferFilterInterface
{

    public function city_id($id)
    {
        $this->builder->where('users_info.city_id', $id);
    }

    public function speciality_id($id)
    {
        $this->builder->where('users_info.speciality_id', $id);
    }
}
