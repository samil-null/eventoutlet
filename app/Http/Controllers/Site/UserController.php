<?php

namespace App\Http\Controllers\Site;

use App\Factories\Offer\OfferFactory;
use App\Utils\Seo\Seo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with('activeServices.activeOffers.dates', 'activeServices.priceOption')->findOrFail($id);

        $dates = collect([]);
        $dataOffers = collect([]);

        foreach ($user->activeServices as $service) {

            foreach ($service->activeOffers as  $offer) {
                $dates = $dates->merge($offer->dates->pluck('date'));
                $dataOffers->push($offer);
            }

        }

        $offers = (new OfferFactory($dataOffers))->create();

        Seo::user($user);

        return view('site.users.show', compact('user', 'dates', 'offers'));
    }
}
