<?php


namespace App\Filters\Offers;


use App\Helpers\DateHelper;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;

class OfferFilter extends BaseOfferFilter implements OfferFilterInterface
{

    protected $availableFilters = [
        'city', 'speciality'
    ];

    protected $select = [
        'users.name','users.id', 'users.avatar', 'services.user_id',
        'services.name as service_name', 'services.id as service_id', 'services.price as service_price', 'services.price_option_id',
        'users_info.instagram','offers.discount','offers.discount_price',
        'users_info.speciality_id','users_info.whatsapp', 'users_info.email', 'users_info.phone'
    ];

    public function setup()
    {
        $this->builder->join('services', function ($query) {
            $query->on('users.id', '=', 'services.user_id')
                ->where('services.status', Service::ACTIVE_STATUS);
        })
        ->leftJoin('offers', function ($query) {
            $query->on('offers.service_id', '=', 'services.id')
                ->where('offers.status', Offer::ACTIVE_STATUS);
        });
    }
}
