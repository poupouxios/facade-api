<?php

namespace FacadeApi\Helpers;

use FacadeApi\Handlers\GuzzleApiHandler;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class ApiWrapperHelper
{

    public function token($token = "")
    {
        if(strlen($token) > 0){
            session(['auth_token' => $token]);
        }
        return $this->getApiAuthToken();
    }

    public function call($verb,$route,array $data = [])
    {
        try{
            $apiHandler = new GuzzleApiHandler($route,
                $data,
                $this->getApiHeaders()
            );
            $response = $apiHandler->$verb();
            if($response)
            {
                return $response;
            }
            return null;
        }catch(Exception $e){
            $response = new \stdClass();
            $response->error = $e->getMessage();
            return $response;
        }
    }

    public function getApiHeaders()
    {
        $enable_token = Config::get("facadeapi.api_enable_authorization_header");
        $headers = [];
        if($enable_token){
            $headers = [
                "Authorization" => "Bearer ".$this->getApiAuthToken()
            ];
        }
        return $headers;
    }

    private function getApiAuthToken()
    {
        $token = Session::get('auth_token');
        if(isset($token) && strlen($token) > 0)
        {
            return $token;
        }
        return "";
    }

}

?>
