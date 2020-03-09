<?php

namespace App\Providers;


use App\Utils\Media\Imager;
use App\Utils\Social;
use Illuminate\Support\ServiceProvider;

class ImagerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('imager', Imager::class);
        $this->app->singleton('social', Social::class);
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
