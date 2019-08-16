<?php

namespace NotaFiscalSP\Helpers;

use Spatie\ArrayToXml\ArrayToXml;

class Xml
{
    public static function toArray($xml)
    {
        $obj = simplexml_load_string($xml, null, LIBXML_NOCDATA);
        return json_decode(json_encode($obj), true);
    }

    public static function makeRequest($root, $array)
    {
        return ArrayToXml::convert($array, [
            'rootElementName' => $root,
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }
}