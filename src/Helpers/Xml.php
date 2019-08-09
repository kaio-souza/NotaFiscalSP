<?php
namespace NotaFiscalSP\Helpers;
class Xml{
    public static function toArray($xml) {
        $xmlObject = is_object($xml) ? $xml : simplexml_load_string($xml);
        foreach((array) $xmlObject as $index => $node)
            $out[$index] = ( is_object($node) || is_array($node) ) ? Xml::toArray( $node ) : $node;
        return $out;
    }
}