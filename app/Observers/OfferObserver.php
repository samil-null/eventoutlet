<?php

namespace App\Observers;

use App\Models\Offer;

class OfferObserver
{
    /**
     * @param Offer $offer
     */
    public function creating(Offer $offer)
    {
        $offer->calculateDiscountPrice();
    }

    public function updating(Offer $offer)
    {
        $offer->calculateDiscountPrice();
    }

    /**
     * Handle the offer "created" event.
     *
     * @param  \App\Models\Offer  $offer
     * @return void
     */
    public function created(Offer $offer)
    {

    }

    /**
     * Handle the offer "updated" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "deleted" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function deleted(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "restored" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function restored(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "force deleted" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function forceDeleted(Offer $offer)
    {
        //
    }

    private function calculateDiscount($offer)
    {


        return $offer;
    }
}
