<?php


namespace App\Filters;

use App\Helpers\DateHelper;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class _UserFilter extends Filter
{
    /**
     * @var array
     */
    protected static $publicFilters = [
        'city_id',
        'speciality_id',
        'specials_offers',
        'discount_to',
        'discount_from'
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

        $this->builder->with([
            'offers' => function ($query) use ($dateFrom, $dateTo) {
                    $query->betweenDates($dateFrom, $dateTo)
                        ->where('offers.status', Offer::ACTIVE_STATUS);
            },
        ]);

        $this->builder->whereHas('offers', function (Builder $query) use ($dateFrom, $dateTo) {
            $query->betweenDates($dateFrom, $dateTo)
                ->where('offers.status', Offer::ACTIVE_STATUS);
        });

        $this->builder->whereHas('offers', function (Builder $query) use ($dateFrom, $dateTo) {
            $query->where('offers.discount', '>=', 40);
        });

    }

    /**
     * @param $value
     */
    public function discount_from($value)
    {
        $this->builder->whereHas('offers', function ($query) use ($value) {
            $query->betweenDiscount('>=', $value);
        });
    }

    /**
     * @param $value
     */
    public function discount_to($value)
    {
        $this->builder->whereHas('offers', function ($query) use ($value) {
            echo $query->betweenDiscount('<=', $value)->toSql();
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
        $this->builder->with('offers.dates', 'offers.service.priceOption');

        if (!$this->user || !$this->user->hasRole('admin')) {
            $this->builder->where('status', User::ACTIVE_STATUS);
        }
    }
}
