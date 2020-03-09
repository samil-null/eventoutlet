<?php


namespace App\Services\Offer;


use App\Models\Offer;

class OfferPublishService
{
    public function execute($offers, $user)
    {
        $user->offers()->update([
            'offers.status' => Offer::NO_ACTIVE
        ]);

        $user->offers()->whereIn('offers.id', $offers)->update([
            'offers.status' => Offer::ACTIVE_STATUS
        ]);
    }
}
