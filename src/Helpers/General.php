<?php

namespace NotaFiscalSP\Helpers;

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
}