<?php

namespace App\Providers;

use App\Models\Offer;
use App\Models\OfferDate;
use App\Models\Service;
use Illuminate\Support\Facades\Blade;
use App\Observers\OfferDateObserver;
use App\Observers\OfferObserver;
use App\Observers\ServiceObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
