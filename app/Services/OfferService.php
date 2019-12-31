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
        $offers = [];

        foreach ($request->input('dates') as $date) {
            $offers[] = new OfferDate([
                'date' => Carbon::parse($date)->format('Y-m-d'),
            ]);
        }

        $offer = $user->offers()->save(new Offer(
            $request->only(['service_id', 'description', 'discount']
        )));

        $offer->calculateDiscount();

        $offer->offerDates()->saveMany($offers);

    }

    private function makeGroupName($id)
    {
        return Str::random(20) . time() . "-" . $id;
    }

    public function getOffersList()
    {

    }

}
