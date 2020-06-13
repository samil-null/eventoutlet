<?php

namespace App\Http\Controllers\Site;

use App\Factories\Algo\AlgoFactoryInterface;
use App\Filters\Offers\OfferFilter;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Utils\Seo\SEO;
use SEOMeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, AlgoFactoryInterface $factory)
    {
        SEO::page('home');

        $filter = (new OfferFilter($request))->apply();

        $users = $factory->load(
            $filter->get()->orderBy('users.id', 'DESC')->take(2)->get(), false)
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
