<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\OfferFilterService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * @var OfferFilterService
     */
    private $offerFilter;

    /**
     * OfferController constructor.
     * @param OfferFilterService $offerFilter
     */
    public function __construct(OfferFilterService $offerFilter)
    {
        $this->offerFilter = $offerFilter;
    }

    public function index(Request $request)
    {
        $users = $this->offerFilter->handle($request)->get();

        return view('site.offers.index', [
            'users' => $users,
        ]);
    }
}
