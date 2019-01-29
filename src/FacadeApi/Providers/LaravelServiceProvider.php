<?php

namespace FacadeApi\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Load the config file to be discoverable from Laravel
     */
    public function boot()
    {
        $path = realpath(__DIR__.'/../../../config/config.php');

        $this->publishes([$path => config_path('facadeapi.php')], 'config');
        $this->mergeConfigFrom($path, 'facadeapi');
    }
}
