<?php

namespace NotaFiscalSP\Helpers;


class Xml
{
    public static function toArray($xml)
    {
        $obj = simplexml_load_string($xml, null, LIBXML_NOCDATA);
        return json_decode(json_encode($obj), true);
    }

}