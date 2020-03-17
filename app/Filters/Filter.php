<?php


namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var
     */
    protected $builder;

    /**
     * Filter constructor.
     * @param Request $request
     */

    /**
     * @var mixed
     */
    protected $user;

    /**
     * Filter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = $request->user();
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        $this->default();
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter) && $value && $this->approveFilter($filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }

    public function approveFilter($filter)
    {

        if (in_array($filter, static::$publicFilters) || $this->user && $this->user->hasRole('admin')) return true;
    }
}
