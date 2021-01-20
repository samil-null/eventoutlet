<?php

namespace App\Http\Controllers\Site;

use App\Factories\Offer\OfferFactory;
use App\Models\City;
use App\Models\Specialty;
use App\Models\UserInfo;
use App\Utils\Seo\SEO;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($slug)
    {
        $user = User::with('activeServices.activeOffers.dates', 'activeServices.priceOption', 'speciality')
            ->where('slug', $slug)
            ->firstOrFail();

        $user_data = UserInfo::where('user_id', $user->id)->first();
        $city = City::where('id', $user_data->city_id)->first();
        $spec = Specialty::where('id', $user_data->speciality_id)->first();

        return redirect()->route('site.users.show2', [
            'city' => $city->slug,
            'slug' => $spec->slug,
            'user' => $user->slug
        ]);

        $dates = collect([]);
        $dataOffers = collect([]);

        foreach ($user->activeServices as $service) {

            foreach ($service->activeOffers as  $offer) {
                $dates = $dates->merge($offer->dates->pluck('date'));
                $dataOffers->push($offer);
            }

        }

        $offers = (new OfferFactory($dataOffers))->create();
        SEO::user($user);

        return view('site.users.show', compact('user', 'dates', 'offers'));
    }

    public function show2(string $slug, string $city, string $user)
    {
        $city = City::where('slug', $city)->firstOrFail();

        $user = User::with('activeServices.activeOffers.dates', 'activeServices.priceOption', 'speciality')
            ->leftJoin('users_info', 'users.id', '=', 'users_info.user_id')
            ->where('slug', $user)
            ->where('users_info.city_id', $city->id)
            ->select('users.*')
            ->firstOrFail();

        $dates = collect([]);
        $dataOffers = collect([]);

        foreach ($user->activeServices as $service) {

            foreach ($service->activeOffers as  $offer) {
                $dates = $dates->merge($offer->dates->pluck('date'));
                $dataOffers->push($offer);
            }

        }

        $offers = (new OfferFactory($dataOffers))->create();
        SEO::user($user);

        return view('site.users.show', compact('user', 'dates', 'offers'));
    }
}
