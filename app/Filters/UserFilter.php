<?php


namespace App\Filters;

use App\Helpers\DateHelper;
use App\Models\User;
use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
//    public $relations = [
//        'specials_offers' => ['date_from', 'date_to'],
//    ];

    public function status($status)
    {
        $this->where('status', $status);
    }

    public function speciality($id)
    {
        $this->related('info', 'speciality_id','=', $id);
    }

    public function city($id)
    {
        $this->related('info', 'city_id','=', $id);
    }

    public function specialsOffers($params)
    {
        $dateFrom = DateHelper::filterPrepare($params['date_from'], 'from');
        $dateTo = DateHelper::filterPrepare($params['date_to'], 'to');

        $this->related('activeServices.activeOffers.dates', function ($query) use ($dateFrom, $dateTo) {
            $query->between($dateFrom, $dateTo);
        });

        $this->with(['activeServices.activeOffers.dates' => function ($query) use ($dateFrom, $dateTo) {
            $query->between($dateFrom, $dateTo);
        }]);
    }

    public function setup()
    {
        $this->with('gallery');
        $this->where('status', User::ACTIVE_STATUS);
    }
}
