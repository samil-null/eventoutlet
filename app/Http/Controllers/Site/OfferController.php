<?php

namespace App\Http\Controllers\Site;

use App\Factories\Algo\AlgoFactoryInterface;
use App\Factories\AlgoFactory;
use App\Filters\Offers\OfferFilterInterface;
use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Offer;
use App\Models\PriceOption;
use App\Models\Service;
use App\Models\Specialty;
use App\Models\User;
use App\Services\FilterBuilderService;
use App\Services\OfferFilterService;
use App\Services\UserFilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{

    /**
     * @var UserFilterService
     */
    private $filter;

    /**
     * OfferController constructor.
     * @param OfferFilterService $filter
     */
    public function __construct(OfferFilterService $filter)
    {
        $this->filter = $filter;
    }


    public function index(Request $request, OfferFilterInterface $filter, AlgoFactoryInterface $factory)
    {

        $users = $factory->load($filter->apply()->paginate(20))->create();

        return view('site.offers.index', [
            'users' => $users,
        ]);
    }
}
