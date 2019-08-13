<?php
namespace NotaFiscalSP\Factories;

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;

class BaseEntitiesFactory{
    public static function makeBaseInformation( $params)
    {
        $baseInformation = new BaseInformation();
        $baseInformation->setCnpj(General::param($params, Params::CNPJ));
        $baseInformation->setCertificate($params);
        $baseInformation->setCertificatePass(General::param($params, Params::CERTIFICATE_PASS));
        $baseInformation->setIm(General::param($params, Params::IM));
        return $baseInformation;

    }
}