<?php

namespace NotaFiscalSP\Helpers;



use NotaFiscalSP\Contracts\UserRequest;

class General
{
    /**
     * @param $array
     * @param $keyPath
     * @return mixed|null
     *  Gets a array key path like 'key1.key2.key3' and returns $array[key1][key2][key3]
     */
    public static function getPath($array, $keyPath)
    {
        $keys = explode('.', $keyPath);
        $response = $array;

        foreach ($keys as $key) {
            $response = General::getKey($response, $key);
            if (!$response) break;
        }
        return $response;
    }

    public static function getKey($array, $key)
    {
        return isset($array[$key]) ? $array[$key] : null;
    }

    public static function onlyNumbers($value)
    {
        return preg_replace("/\D+/", "", $value);
    }

    public static function filterDate($date)
    {
        if (strpos($date, '/') !== false) {
            $date = implode('-', array_reverse(explode('/', $date)));
        }
        return $date;
    }

    public static function convertUserRequest($request){

        if($request instanceof UserRequest)
            return $request->toArray();

        if(is_array($request)){
            $finalRequest = [];
            foreach ($request as $item){
                if($item instanceof UserRequest){
                    $finalRequest[] = $item->toArray();
                } else {
                    if(is_array($item))
                        $finalRequest[] = $item;
                }
            }
            return count($finalRequest) ? $finalRequest : $request ;
        }

        return [];

    }

}