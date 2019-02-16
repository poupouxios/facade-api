<?php

namespace FacadeApi\Handlers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use FacadeApi\Interfaces\ClientHandlerInterface;
use Illuminate\Support\Facades\Config;

class GuzzleApiHandler implements ClientHandlerInterface{

    private $data = [];
    private $route = "";
    private $headers = [];
    private $client;

    public function __construct($route,array $data=[],array $headers=[])
    {
        $this->route = $route;
        $this->data = $data;
        $this->headers = $headers;
    }

    public function post()
    {
        try
        {
            $this->prepareClient();
            $response = $this->client->request('POST',$this->route,[
                "form_params" => $this->data
            ]);
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            $response = new \stdClass();
            $response->error = $e->getMessage();
            return $response;
        }
    }

    public function put()
    {
        try
        {
            $this->prepareClient();
            $response = $this->client->request('PUT',$this->route,[
                "form_params" => $this->data
            ]);
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            $response = new \stdClass();
            $response->error = $e->getMessage();
            return $response;
        }
    }

    public function get()
    {
        try
        {
            $this->prepareClient();
            $response = $this->client->request('GET',$this->route,
                ['query' => $this->data]
            );
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            $response = new \stdClass();
            $response->error = $e->getMessage();
            return $response;
        }
    }

    public function delete()
    {
        try
        {
            $this->prepareClient();
            $response = $this->client->request('DELETE',$this->route,[
                "json" => $this->data
            ]);
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            $response = new \stdClass();
            $response->error = $e->getMessage();
            return $response;
        }
    }

    private function prepareClient()
    {
        $this->client = new Client([
            'base_uri' => Config::get("facadeapi.api_container_name"),
            'headers' => $this->headers
        ]);
        if($this->route[0] != "/")
        {
            $this->route = "/".$this->route;
        }
    }

}
