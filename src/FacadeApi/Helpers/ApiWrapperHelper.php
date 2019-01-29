<?php

  namespace FacadeApi\Helpers;

  use FacadeApi\Handlers\GuzzleApiHandler;

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
              if($response && property_exists($response,'success'))
              {
                 return $response->success;
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
          $headers = [
            "Authorization" => "Bearer ".$this->getApiAuthToken()
          ];
          return $headers;
      }

      private function getApiAuthToken()
      {
          $token = \Session::get('auth_token');
          if(isset($token) && strlen($token) > 0)
          {
            return $token;
          }
          return "";
      }

  }

?>
