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
        return preg_replace("/\D+/", "", (string)$value);
    }

    public static function filterDate($date)
    {
        if (strpos($date, '/') !== false) {
            $date = implode('-', array_reverse(explode('/', $date)));
        }
        return $date;
    }

    public static function filterString($value){
        $unwanted_array = array('?' => '','!' => '','#' => '','$' => '','_' => '',']' => '','[' => '',')' => '', '(' => '','-' => '','.' =>'',',' => '','Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        return trim(strtr( $value, $unwanted_array));
    }

    public static function filterMonetaryValue($value){
        return number_format((float)$value, 2, '.','');
    }

    public static function convertUserRequest($request)
    {
        if ($request instanceof UserRequest)
            return $request->toArray();

        if (is_array($request)) {
            $finalRequest = [];
            foreach ($request as $item) {
                if ($item instanceof UserRequest) {
                    $finalRequest[] = $item->toArray();
                } else {
                    if (is_array($item))
                        $finalRequest[] = $item;
                }
            }
            return count($finalRequest) ? $finalRequest : $request;
        }

        return [];

    }

}
