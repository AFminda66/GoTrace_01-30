<?php

namespace App\Http\Services;

use App\Http\Services\WebServiceReply;

class API
{
    public function curlInit($options)
    {
        if(!$options || !is_array($options))
        return (new WebServiceReply)->generate('Servicio no disponible (OPTIONS)');

        if(!isset($options['method']) || !$options['method'] || !is_string($options['method']))
        return (new WebServiceReply)->generate('Servicio no disponible (METHOD)');

        if(!in_array($options['method'], ['POST', 'GET']))
        return (new WebServiceReply)->generate('Servicio no disponible (METHOD)');
    
        if(!isset($options['host']) || !$options['host'] || !is_string($options['host']))
        return (new WebServiceReply)->generate('Servicio no disponible (HOST)');
    
        if(!isset($options['path']) || !$options['path'] || !is_string($options['path']))
        return (new WebServiceReply)->generate('Servicio no disponible (PATH)');
        
        if(!isset($options['parameters']) || !is_array($options['parameters']))
        return (new WebServiceReply)->generate('Servicio no disponible (PARAMETERS)');
        
        $headers = [];

        $ch = curl_init();

        if(isset($options['headers']) && $options['headers'] && is_array($options['headers'])){
            foreach($options['headers'] as $header){
                $headers[] = $header;
            }
        }

        if($options['method'] == 'POST'){
            curl_setopt($ch, CURLOPT_URL, $options['host'].'/'.$options['path']);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $options['parameters']);
        }
        else{
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_URL, $options['host'].'/'.$options['path'].'?'.http_build_query($options['parameters']));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if(!$result || !is_array($result) || !isset($result['status']))
        return (new WebServiceReply)->generate('Servicio no disponible');
        
        return $result;
    }
    
    public function login($data)
    {
        return $this->curlInit([
            'method' => 'POST',
            'host' => $_ENV['HOST_GO_TRADE'],
            'path' => 'api/v1/login', 
            'parameters' => $data
        ]);    
    }

    public function getRutas($data, $header)
    {
        return $this->curlInit([
            'method' => 'GET',
            'host' => $_ENV['HOST_GO_TRADE'],
            'path' => 'api/v1/rutas/lista-de-rutas/568cf8ce-a2d6-411b-85bf-d9678c2a8c4b', 
            'parameters' => $data,
            'headers' => $header
        ]);    
    }
}
