<?php

namespace NotaFiscalSP\Factories;

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;

class BaseEntitiesFactory
{
    public static function makeBaseInformation($params)
    {
        $baseInformation = new BaseInformation();
        $baseInformation->setCnpj(General::getPath($params, Params::CNPJ));
        $baseInformation->setCertificate($params);
        $baseInformation->setCertificatePass(General::getPath($params, Params::CERTIFICATE_PASS));
        $baseInformation->setIm(General::getPath($params, Params::IM));
        return $baseInformation;

    }
}