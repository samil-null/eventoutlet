<?php


namespace App\Filters\Offers;


use App\Helpers\DateHelper;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;

class SpecialOfferFilter extends OfferFilter implements OfferFilterInterface
{
    protected $select = [
        'users.name','users.id', 'users.avatar', 'services.user_id',
        'services.name as service_name', 'services.id as service_id', 'services.price_option_id',
        'users_info.instagram','offers.discount','offers.discount_price',
        'users_info.speciality_id','users_info.whatsapp', 'users_info.email', 'users_info.phone'
    ];

    public function specials_offers($params)
    {
        $dateFrom = DateHelper::filterPrepare($params['date_from']??'', 'from');
        $dateTo = DateHelper::filterPrepare($params['date_to']??'', 'to');

        $this->builder->join('services', function ($query) {
            $query->on('users.id', '=', 'services.user_id')
                ->where('services.status', Service::ACTIVE_STATUS);
        })
        ->join('offers', function ($query) {
            $query->on('offers.service_id', '=', 'services.id')
                ->where('offers.status', Offer::ACTIVE_STATUS);
        })
        ->join('offers_dates', function ($query) use ($dateFrom, $dateTo) {
            $query->on('offers.id', '=', 'offers_dates.offer_id')
                ->whereBetween('offers_dates.date', [$dateFrom, $dateTo]);
        });
    }

    public function discount_from($value)
    {
        $this->builder->where('offers.discount','>=', intval($value));
    }

    public function discount_to($value)
    {
        $this->builder->where('offers.discount','<=', intval($value));
    }

    public function apply()
    {
        parent::apply();
        $this->builder->select($this->select);

        return $this->builder->groupBy('users.id');
    }
}
