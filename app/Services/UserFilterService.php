<?php


namespace App\Services;

use App\Helpers\DateHelper;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserFilterService
{
    /**
     * @var array
     */
    private $filters = [];

    /**
     * @var bool
     */
    private $isAdmin = false;

    /**
     * @var array
     */
    private $onlyAdminFilters = [
        'user_status'
    ];

    private $availableFilters = [
        'city_id',
        'user_status',
        'speciality_id',
        'specials_offers',
        'discount'
    ];

    /**
     * @var array
     */
    private $relation = [
        'info', 'offers.dates'
    ];

    /**
     * @var User $builder
     */
    private $builder;

    /**
     * @param Request $request
     * @param $user
     * @return mixed
     */
    public function apply(Request $request, $user = null)
    {
        $this->init($user, $request->all());
        $this->make($request->all());

        return $this->builder;
    }

    /**
     * @param $filters
     */
    public function make($filters)
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter) && in_array($filter, $this->availableFilters)) {
                $this->$filter($value);
            }
        }
    }

    /**
     * @param $user
     * @param $filters
     */
    private function init($user, $filters)
    {
        $this->filters = $filters;
        $this->builder = User::with($this->relation);

        if ($user && $user->hasRole('admin')) {
            $this->isAdmin = true;
        } else {
            $this->default();
        }

    }

    public function city_id($value)
    {
        $this->builder->whereHas('info', function ($query) use ($value) {
            $query->where('city_id', $value);
        });
    }

    public function speciality_id($value)
    {
        $this->builder->whereHas('info', function ($query) use ($value) {
            $query->where('speciality_id', $value);
        });
    }

    public function specials_offers($value)
    {
        $dateFrom = DateHelper::filterPrepare($this->filters['date_from'], 'from');
        $dateTo = DateHelper::filterPrepare($this->filters['date_to'], 'to');

        $this->builder->whereHas('offers.dates', function (Builder $query) use ($dateFrom, $dateTo) {
            $query->where('status', Offer::ACTIVE_STATUS)
                ->where('date', '>=', $dateFrom)
                ->where('date', '<=', $dateTo);
        });
    }

    public function discount($value)
    {
        $this->builder->whereHas('offers', function ($query) use ($value)  {
            $query->where('discount',$value);
        });
    }

    public function user_status($value)
    {
        $this->builder->where('status', $value);
    }

    public function default()
    {
        $this->builder->where('status', User::ACTIVE_STATUS);
    }
}
