<?php


namespace App\Filters\Offers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class BaseOfferFilter
{
    protected $builder;

    protected $request;

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
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
    }
}
