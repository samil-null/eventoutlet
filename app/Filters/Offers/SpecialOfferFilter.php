<?php


namespace App\Filters\Offers;


use App\Helpers\DateHelper;
use App\Models\AdditionFieldSpeciality;
use App\Models\Offer;
use App\Models\Service;


class SpecialOfferFilter extends BaseOfferFilter implements OfferFilterInterface
{

    protected $availableFilters = [
        'city', 'speciality', 'date', 'discount'
    ];

    public function specials_offers($params)
    {
        $dateFrom = DateHelper::filterPrepare($params['date_from']??'', 'from');
        $dateTo = DateHelper::filterPrepare($params['date_to']??'', 'to');

        $this->params['date_from'] = $dateFrom;
        $this->params['date_to'] = $dateTo;

        $this->builder->join('offers_dates', function ($query) use ($dateFrom, $dateTo) {
            $query->on('offers.id', '=', 'offers_dates.offer_id')
                ->whereBetween('offers_dates.date', [$dateFrom, $dateTo]);
        });
    }

    public function discount($params)
    {
        $this->params['discount_from'] =  intval($params['from']);
        $this->params['discount_to'] =  intval($params['to']);

        $this->builder->whereBetween('offers.discount', [intval($params['from']), intval($params['to'])]);
    }

    public function setup()
    {
        $this->builder->join('services', function ($query) {
            $query->on('users.id', '=', 'services.user_id')
                ->where('services.status', Service::ACTIVE_STATUS);
        })
        ->join('offers', function ($query) {
            $query->on('offers.service_id', '=', 'services.id')
                ->where('offers.status', Offer::ACTIVE_STATUS);
        });
    }

    public function additional_fields($fields)
    {
        $this->builder->whereIn('services.id', function ($query) use ($fields) {
            $query->from('additional_fields_services')
                ->whereNotNull('value')
                ->select('service_id');

            foreach ($fields as $id => $value) {
                if (!$value) continue;

                $query->orWhere(function ($sub) use ($id, $value) {
                    $sub->where('speciality_field_id', $id)
                        ->where('value', '>=', $value);
                });
            }

        });

    }

    public function additionsFields()
    {
        if ($this->request->has('speciality_id')) {
            return AdditionFieldSpeciality::where('speciality_id', $this->request->input('speciality_id'))->get();
        }

        return [];
    }

}
