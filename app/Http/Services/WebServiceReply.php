<?php

namespace App\Http\Services;

class WebServiceReply
{
    public static function generate($data, $message = null)
    {
        if(is_array($data) && $message)
        $message = null;
        elseif(is_string($data)){
            $message = $data;
            $data = [];
        }
        
        $result = [
            'status' => ($message ? 0 : 1),
            'code' => $message ? 400 : 200,
            'message' => $message
        ];
        
        return $result;
    }
}