<?php

namespace App\Services;

use App\Models\OfferDate;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class OfferService
{
    public function create(User $user, Request $request)
    {
        
        $dates = array_map(function ($date) {
            return new OfferDate(['date' => $date]);
        }, $request->input('dates'));

        $service = $user->services()->where('id', $request->input('service_id'))->first();

        $offer = $service->offers()->save(
            new Offer([
                'description' => $request->input('description'),
                'discount' => $request->input('discount'),
                'status' => Offer::ACTIVE_STATUS
            ])
        );

        $offer->dates()->saveMany($dates);

        return $offer;
    }

    public function update($offer, $request)
    {
        $dates = array_map(function ($date) {
            return new OfferDate(['date' => $date]);
        }, $request->input('dates'));

        $offer->dates()->delete();
        $offer->dates()->saveMany($dates);

        $offer->update([
            'service_id' => $request->input('service_id'),
            'description' => $request->input('description'),
            'discount' => $request->input('discount'),
            'status' => Offer::WAITING_STATUS
        ]);
    }

    public function published($offers, $user)
    {
        $user->offers()->update([
            'offers.status' => Offer::NO_ACTIVE
        ]);

        $user->offers()->whereIn('offers.id', $offers)->update([
            'offers.status' => Offer::ACTIVE_STATUS
        ]);


    }
}
