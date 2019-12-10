<?php

namespace App\Services;

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
        $group = $this->makeGroupName($user->id);

        foreach ($request->input('dates') as $date) {
            $offers[] = new Offer([
                'date' => Carbon::parse($date)->format('Y-m-d'),
                'group' => $group,
                'description' => $request->input('description'),
                'discount' => $request->input('discount'),
            ]);
        }

        $user->offers()->saveMany($offers);
    }

    private function makeGroupName($id)
    {
        return Str::random(20) . time() . "-" . $id;
    }

    public function getOffersList()
    {

    }
}
