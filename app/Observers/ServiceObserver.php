<?php

namespace App\Observers;

use App\Models\Offer;
use App\Models\Service;

class ServiceObserver
{
    public function creating(Service $service)
    {

    }

    public function updating(Service $service)
    {
        $service->offers->map(function ($offer) {
            $offer->calculateDiscountPrice();
            $offer->save();
        });

//        if ($service->status !== Service::ACTIVE_STATUS) {
//            $service->offers->map(function ($offer) {
//                $offer->status = Offer::WAITING_STATUS;
//                $offer->save();
//            });
//        }
    }
    /**
     * Handle the service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        //
    }

    /**
     * Handle the service "updated" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        //
    }

    /**
     * Handle the service "deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        //
    }

    /**
     * Handle the service "restored" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function restored(Service $service)
    {
        //
    }

    /**
     * Handle the service "force deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        //
    }
}
