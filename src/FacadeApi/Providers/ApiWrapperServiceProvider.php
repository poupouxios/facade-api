<?php

namespace FacadeApi\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ApiWrapperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('apiwrapper', function()
        {
            return new \FacadeApi\Helpers\ApiWrapperHelper;
        });
    }
}
