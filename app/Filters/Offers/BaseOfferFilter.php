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

    public $params = [];

    protected $select = [
        'users.name','users.id', 'users.slug', 'users.avatar', 'services.user_id',
        'services.name as service_name', 'services.id as service_id','services.price as service_price',
        'services.price_option_id', 'users_info.instagram','offers.discount','offers.discount_price',
        'users_info.speciality_id','users_info.whatsapp', 'users_info.email', 'users_info.phone'
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->builder = DB::table('users')
            ->where('users.status', User::ACTIVE_STATUS)
            ->join('users_info', 'users.id', '=', 'users_info.user_id');
    }

    public function filters()
    {
        return $this->request->all();
    }

    public function apply()
    {
        $this->setup();

        foreach ($this->filters() as $filter => $value) {

            if (method_exists($this, $filter)) {
                $this->params[$filter] = $value;
                $this->$filter($value);
            }
        }
        return $this;
    }

    public function city_id($id): void
    {
        $this->builder->where('users_info.city_id', $id);
    }

    public function speciality_id($id): void
    {
        $this->builder->where('users_info.speciality_id', $id);
    }

    public function getFilterParam($key)
    {
        return isset($this->params[$key])?$this->params[$key]:null;
    }

    public function search($query): void
    {
//        $pdo = new \PDO('mysql:host=127.0.0.1;port=9306');
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $connection = \DB::connection('sphinx');
//        $userIds = $connection->table('users');
//        dump($userIds->get());

        $this->builder->where('users.name', 'like', "%{$query}%");
    }

    public function get()
    {
        $this->builder->select($this->select);
        return $this->builder->groupBy('users.id');
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
