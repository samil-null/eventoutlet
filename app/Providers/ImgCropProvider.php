<?php

namespace App\Providers;

use App\Services\ResizeService;
use Illuminate\Support\ServiceProvider;

class ImgCropProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('imgcrop', function () {
            return new ResizeService();
        });
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
