<?php

namespace App\Observers;

use App\Models\OfferDate;
use Carbon\Carbon;

class OfferDateObserver
{
    /**
     * @param OfferDate $offerDate
     */
    public function creating(OfferDate $offerDate)
    {
        $offerDate->date = $offerDate->dateFormat();
    }

    public function updating(OfferDate $offerDate)
    {
        $offerDate->date = $offerDate->dateFormat();
    }
    /**
     * Handle the offer date "created" event.
     *
     * @param  \App\Models\OfferDate  $offerDate
     * @return void
     */
    public function created(OfferDate $offerDate)
    {
        //
    }

    /**
     * Handle the offer date "updated" event.
     *
     * @param  \App\Models\OfferDate  $offerDate
     * @return void
     */
    public function updated(OfferDate $offerDate)
    {
        //
    }

    /**
     * Handle the offer date "deleted" event.
     *
     * @param  \App\Models\OfferDate  $offerDate
     * @return void
     */
    public function deleted(OfferDate $offerDate)
    {
        //
    }

    /**
     * Handle the offer date "restored" event.
     *
     * @param  \App\Models\OfferDate  $offerDate
     * @return void
     */
    public function restored(OfferDate $offerDate)
    {
        //
    }

    /**
     * Handle the offer date "force deleted" event.
     *
     * @param  \App\Models\OfferDate  $offerDate
     * @return void
     */
    public function forceDeleted(OfferDate $offerDate)
    {
        //
    }
}
