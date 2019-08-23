<?php

namespace NotaFiscalSP\Factories;

use NotaFiscalSP\Entities\WsdlBase;

class WsdlFactory
{
    public static function make($endpoint)
    {
        $wsdl1 = new WsdlBase();
        $wsdl1->setEndPoint($endpoint);
        return $wsdl1;
    }
}