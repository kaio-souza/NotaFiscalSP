<?php
namespace NotaFiscalSP\Helpers;

use Spatie\ArrayToXml\ArrayToXml;

class Xml{
    public static function toArray($xml) {
        $xmlObject = is_object($xml) ? $xml : simplexml_load_string($xml);
        foreach((array) $xmlObject as $index => $node)
            $out[$index] = ( is_object($node) || is_array($node) ) ? Xml::toArray( $node ) : $node;
        return $out;
    }

    public static function makeRequest($root, $array){
        return ArrayToXml::convert($array, [
            'rootElementName' => $root,
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }
}