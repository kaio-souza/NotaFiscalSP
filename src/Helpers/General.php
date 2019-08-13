<?php
namespace NotaFiscalSP\Helpers;

class General{
    public static function param($params, $key){
        return isset($params[$key]) ? $params[$key] : null;
    }

}