<?php

namespace App\Http\Controllers\Site;

use App\Factories\Algo\AlgoFactoryInterface;
use App\Factories\AlgoFactory;
use App\Filters\Offers\OfferFilterInterface;
use App\Filters\UserFilter;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\City;
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

    public function index(Request $request, OfferFilterInterface $filter, AlgoFactoryInterface $factory)
    {
        $result = $filter->apply();
        $aggregate = $result->aggregate();
        $additionFields = $result->additionsFields();
        $users = $factory->load($result->get()->paginate(20), $request->has('specials_offers'))->create();

        $filters = [
            'availableFilters' => $result->getAvailableFilters(),
            'cities' => [
                'options' => (new City())->active()->get()->toJson(),
                'active' => $request->input('city_id')??0
            ],
            'specialities' => [
                'options' => (new Specialty())->active()->get()->toJson(),
                'active' => $request->input('speciality_id')??0
            ],
            'dates' => [
                'from' => $result->getFilterParam('date_from'),
                'to' => $result->getFilterParam('date_to'),
                'to_date_filter' => DateHelper::toDateFilter($result->getFilterParam('date_to')),
                'max_date' => DateHelper::maxFilterDate(),
                'min_date' => DateHelper::minFilterDate()
            ],
            'discount' => [
                'from' => $result->getFilterParam('discount_from'),
                'to' => $result->getFilterParam('discount_to'),
            ]
        ];

        return view('site.offers.index', [
            'users' => $users,
            'filters' => $filters
        ]);
    }
}
