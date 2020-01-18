<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\FilterBuilderService;
use App\Services\OfferFilterService;
use App\Services\UserFilterService;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    /**
     * @var UserFilterService
     */
    private $filter;

    /**
     * OfferController constructor.
     * @param UserFilterService $filter
     */
    public function __construct(UserFilterService $filter, FilterBuilderService $builder)
    {
        $this->filter = $filter;
        $this->builder = $builder;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = $this->filter->apply($request)->paginate(10);

        $filter = $this->builder->create($request);

        dd($filter);

        return view('site.offers.index', [
            'users' => $users,
        ]);
    }
}
