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

    public static function makeRequestXML($endPoint, $request)
    {
        return ArrayToXml::convert($request, [
            'rootElementName' => 'p1:Pedido' . $endPoint,
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
            ],
        ], true, 'UTF-8');
    }

    public static function makeNFTSRequestXML($endPoint, $request)
    {
        return ArrayToXml::convert($request, [
            'rootElementName' => 'p1:Pedido' . $endPoint,
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfts',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
            ],
        ], true, 'UTF-8');
    }

}