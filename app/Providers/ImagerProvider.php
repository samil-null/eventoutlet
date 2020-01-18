<?php

namespace App\Providers;

use App\Services\ResizeService;
use App\Utils\Media\Imager;
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
