<?php

namespace FacadeApi\Providers;

use Illuminate\Support\ServiceProvider;

class LumenServiceProvider extends ServiceProvider
{
    /**
     * Load the config file to be discoverable from Laravel
     */
    public function boot()
    {
        $this->app->configure('facadeapi');

        $path = realpath(__DIR__.'/../../../config/config.php');
        $this->mergeConfigFrom($path, 'facadeapi');
    }
}
