<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class OfferFilterProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Filters\Offers\OfferFilterInterface',
            $this->app->request->has('specials_offers')?
                'App\Filters\Offers\SpecialOfferFilter':
                'App\Filters\Offers\OfferFilter'
        );

        $this->app->bind(
            \App\Factories\Algo\AlgoFactoryInterface::class,
            \App\Factories\Algo\AlgoFactory::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
