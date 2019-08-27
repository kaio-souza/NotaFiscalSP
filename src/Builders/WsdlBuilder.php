<?php

namespace NotaFiscalSP\Builders;

use NotaFiscalSP\Entities\WsdlBase;

class WsdlBuilder
{
    public static function make($endpoint)
    {
        $wsdl1 = new WsdlBase();
        $wsdl1->setEndPoint($endpoint);
        return $wsdl1;
    }
}