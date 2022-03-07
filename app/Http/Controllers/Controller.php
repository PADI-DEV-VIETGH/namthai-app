<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $baseUrl;

    public function setOptions($options = [])
    {
        if(isset($options['base_url']) && $options['base_url']){
            $this->baseUrl = $options['base_url'];
        }
    }

    public function get($endPoint = "", $params = [])
    {
        try{
            $url = $this->baseUrl.'/'.$endPoint;
            $response = Http::get($url, $params);
            if($response->successful()){
                $data = [];
                if($response->successful()){
                    $data = $response->json();
                }
                return $data;
            }else{
                throw new \Exception($response->getReasonPhrase());
            }
        }catch (\Exception $e){
            throw $e;
        }

    }

    public function post($endPoint = "", $header =[], $params = [])
    {
        try{
            $url = $this->baseUrl.'/'.$endPoint;
            $response = Http::withHeaders($header)
                ->post($url, $params);
            if($response->successful()){
                $data = [];
                if($response->successful()){
                    $data = $response->json();
                }
                return $data;
            }else{
                throw new \Exception($response->getReasonPhrase());
            }
        }catch (\Exception $e){
            throw $e;
        }

    }
}
