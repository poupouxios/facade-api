<?php

namespace FacadeApi\Facades;
use Illuminate\Support\Facades\Facade;

class ApiWrapper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'apiwrapper'; }
}

?>
