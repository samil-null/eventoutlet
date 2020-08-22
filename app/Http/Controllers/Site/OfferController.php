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
use App\Utils\Seo\SEO;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{

    public function index(Request $request, OfferFilterInterface $filter, AlgoFactoryInterface $factory)
    {

        $perPage = 10;

        if ($request->has('per_page') && is_numeric($request->input('per_page'))) {
            $perPage = $request->input('per_page');
        }

        $result = $filter->apply();
        $additionFields = $result->additionsFields();
        $data = $result->get()->paginate($perPage);
        $users = $factory->load($data, $request->has('specials_offers'))->create();

        $city = City::find($request->input('city_id'));
        $speciality = Specialty::find($request->input('speciality_id'));

        Seo::offers($city, $speciality, $request->has('specials_offers'));

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
            ],
            'additional_fields' => $additionFields,
            'additional_fields_params' => $result->getFilterParam('additional_fields')
        ];

        return view('site.offers.index', [
            'users' => $users,
            'filters' => $filters,
            'pagination' => $data->appends($request->input()),
            'perPage' => $perPage
        ]);

    }

    /**
     * @param string $slug
     */
    public function category(string $slug, Request $request, OfferFilterInterface $filter, AlgoFactoryInterface $factory)
    {

        $speciality = Specialty::where('slug', $slug)->first();

        if (!$speciality) abort(404);

        $perPage = 10;

        if ($request->has('per_page') && is_numeric($request->input('per_page'))) {
            $perPage = $request->input('per_page');
        }

        $filter->speciality_id($speciality->id);

        $result = $filter->apply();

        $additionFields = $result->additionsFields();
        $data = $result->get()->paginate($perPage);
        $users = $factory->load($data, $request->has('specials_offers'))->create();

        $city = City::find($request->input('city_id'));

        Seo::offers($city, $speciality, $request->has('specials_offers'));

        $filters = [
            'availableFilters' => $result->getAvailableFilters(),
            'cities' => [
                'options' => (new City())->active()->get()->toJson(),
                'active' => $request->input('city_id')??0
            ],
            'specialities' => [
                'options' => (new Specialty())->active()->get()->toJson(),
                'active' => $speciality->id??0
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
            ],
            'additional_fields' => $additionFields,
            'additional_fields_params' => $result->getFilterParam('additional_fields')
        ];

        return view('site.offers.index', [
            'users' => $users,
            'filters' => $filters,
            'pagination' => $data->appends($request->input()),
            'perPage' => $perPage
        ]);
    }
}
