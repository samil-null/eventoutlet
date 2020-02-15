<?php


namespace App\Filters\Offers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class BaseOfferFilter
{
    protected $builder;

    protected $request;

    protected $availableFilters = [];

    protected $saveFilterState;

    protected $orderFilters = [
        'city_id',
        'speciality_id',
        'specials_offers',
    ];

    public $params = [];

    protected $select = [
        'users.name','users.id', 'users.avatar', 'services.user_id',
        'services.name as service_name', 'services.id as service_id','services.price as service_price',
        'services.price_option_id', 'users_info.instagram','offers.discount','offers.discount_price',
        'users_info.speciality_id','users_info.whatsapp', 'users_info.email', 'users_info.phone'
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->select[] = DB::raw('max(offers.discount) as max_discount');
        $this->builder = DB::table('users')
            ->where('users.status', User::ACTIVE_STATUS)
            ->join('users_info', 'users.id', '=', 'users_info.user_id');
    }

    public function filters()
    {
        $noOrderingIndex = count($this->orderFilters);

        $orderingFilter = [];

        foreach ($this->request->all() as $name => $value) {

            $index = array_search($name, $this->orderFilters);
            if ($index !== false) {
                $orderingFilter[$index] = [
                    'name' => $name,
                    'value' => $value
                ];
            } else {
                $orderingFilter[$noOrderingIndex] = [
                    'name' => $name,
                    'value' => $value
                ];

                $noOrderingIndex++;
            }

        }
        ksort($orderingFilter);
        return $orderingFilter;
    }

    public function apply()
    {
        $this->setup();

        foreach ($this->filters() as $filter) {
            $filterName = $filter['name'];
            $filterValue = $filter['value'];

            if (method_exists($this, $filterName)) {

                $this->params[$filterName] = $filterValue;
                $this->$filterName($filterValue);

                if (in_array($filterName, $this->orderFilters)) {
                    $this->saveFilterState = clone $this->builder;
                }
            }
        }

        return $this;
    }

    public function city_id($id)
    {
        $this->builder->where('users_info.city_id', $id);
    }

    public function speciality_id($id)
    {
        $this->builder->where('users_info.speciality_id', $id);
    }

    public function getFilterParam($key)
    {
        return isset($this->params[$key])?$this->params[$key]:null;
    }

    public function get()
    {
        $this->builder->select($this->select);
        return $this->builder->groupBy('users.id');
    }

    public function aggregate()
    {
        $builder = $this->saveFilterState??$this->builder;
        $builder->select('offers.id');

        $aggregate = DB::table('offers')->whereRaw("id in ({$builder->toSql()})")
            ->select(DB::raw('max(discount) as max_discount, min(discount) as min_discount,
                        max(discount_price) as max_price, min(discount_price) as min_price'));
        $aggregate->mergeBindings( $builder );

        return $aggregate->first();
    }

    public function getAvailableFilters()
    {
        return $this->availableFilters;
    }

    public static function getQueries($builder)
    {
        $addSlashes = str_replace('?', "'?'", $builder->toSql());
        return vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
    }

}
