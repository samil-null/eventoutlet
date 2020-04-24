<?php

namespace App\Http\Controllers\Site;

use App\Factories\Algo\AlgoFactory;
use App\Factories\Algo\AlgoFactoryInterface;
use App\Filters\Offers\SpecialOfferFilter;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Jobs\RemoveOldOffersDate;
use App\Models\Specialty;
use App\Utils\Seo\SEO;
use SEOMeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, AlgoFactoryInterface $factory)
    {
        SEO::page('home');

        $filter = (new SpecialOfferFilter($request))->apply();

        RemoveOldOffersDate::dispatch();

        $users = $factory->load(
            $filter->get()->orderBy('users.id', 'DESC')->take(2)->get(),
            true
            )
            ->create();

        $specialities = (new Specialty())
            ->active()
            ->get()
            ->toJson();
        return view('site.home.index',[
            'users' => $users,
            'specialities' => $specialities,
            'startDate' => DateHelper::minFilterDate(),
            'endDate' => DateHelper::maxFilterDate()
        ]);
    }
}
