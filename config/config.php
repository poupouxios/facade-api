<?php

return [

      /*
      |--------------------------------------------------------------------------
      | Facade Api Container Name
      |--------------------------------------------------------------------------
      |
      | This config is required to set the base url to make the api call. The
      | reason that we need to set the container name is the way Docker communicates
      | with other containers.
      */

      'api_container_name' => env('API_CONTAINER_NAME')
];
