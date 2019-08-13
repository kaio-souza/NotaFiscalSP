<?php
namespace NotaFiscalSP\Helpers;

class General{
    public static function param($params, $keyList){
        $keys = explode('.', $keyList);
        $response = $params;

        foreach ($keys as $key){
            $response =  isset($response[$key]) ? $response[$key] : null;
            if(!$response) break;
        }


        return $response;
    }





}