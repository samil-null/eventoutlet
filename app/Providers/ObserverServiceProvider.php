<?php

namespace App\Providers;

use App\Models\Offer;
use App\Models\OfferDate;
use App\Models\Service;
use App\Models\User;
use App\Observers\OfferDateObserver;
use App\Observers\OfferObserver;
use App\Observers\ServiceObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Offer::observe(OfferObserver::class);
        Service::observe(ServiceObserver::class);
        OfferDate::observe(OfferDateObserver::class);
        User::observe(UserObserver::class);
    }
}
