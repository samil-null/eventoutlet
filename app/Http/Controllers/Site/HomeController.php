<?php

namespace App\Http\Controllers\Site;

use App\Factories\Algo\AlgoFactory;
use App\Factories\Algo\AlgoFactoryInterface;
use App\Filters\Offers\SpecialOfferFilter;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use SEOMeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, AlgoFactoryInterface $factory)
    {
        $filter = (new SpecialOfferFilter($request))->apply();

        $users = $factory->load(
            $filter->get()->take(2)->get(),
            true)
            ->create();

        $specialities = (new Specialty())
            ->active()
            ->get()
            ->toJson();

        SEOMeta::setTitle('Eventoutlet - поиск специалистов для вашего мероприятия на определенную дату со скидкой.');
        return view('site.home.index',[
            'users' => [],
            'specialities' => $specialities,
            'startDate' => DateHelper::minFilterDate(),
            'endDate' => DateHelper::maxFilterDate()
        ]);
    }
}
