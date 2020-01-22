<?php

namespace App\Http\Controllers\Site;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function __construct(UserFilterService $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, UserFilter $filter)
    {
        $users = (new User())->filter($filter)->with('gallery')->get();

        return view('site.offers.index', [
            'users' => $users,
        ]);
    }
}
