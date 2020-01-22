<?php


namespace App\Filters;

use App\Helpers\DateHelper;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filter
{
    /**
     * @var array
     */
    protected static $publicFilters = [
        'city_id',
        'speciality_id',
        'specials_offers',
        'discount',
    ];

    /**
     * @param $value
     */
    public function city_id($value)
    {
        $this->builder->whereHas('info', function ($query) use ($value) {
            $query->where('city_id', $value);
        });
    }

    /**
     * @param $value
     */
    public function speciality_id($value)
    {
        $this->builder->whereHas('info', function ($query) use ($value) {
            $query->where('speciality_id', $value);
        });
    }

    /**
     * @param $value
     */
    public function specials_offers($value)
    {
        $dateFrom = DateHelper::filterPrepare($this->request->input('date_from'), 'from');
        $dateTo = DateHelper::filterPrepare($this->request->input('date_to'), 'to');

        $this->builder->whereHas('offers.dates', function (Builder $query) use ($dateFrom, $dateTo) {
            $query->where('date', '>=', $dateFrom)
                ->where('date', '<=', $dateTo);
        });

        $this->builder->whereHas('offers', function (Builder $query) {
            $query->where('offers.status', Offer::ACTIVE_STATUS);
        });
    }

    /**
     * @param $value
     */
    public function discount($value)
    {
        $this->builder->whereHas('offers', function ($query) use ($value)  {
            $query->where('discount',$value);
        });
    }

    /**
     * @param $value
     */
    public function user_status($value)
    {
        $this->builder->where('status', $value);
    }


    public function default()
    {
        if (!$this->user || !$this->user->hasRole('admin')) {
            $this->builder->where('status', User::ACTIVE_STATUS);
        }
    }
}
