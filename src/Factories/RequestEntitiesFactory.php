<?php
namespace NotaFiscalSP\Factories;

use NotaFiscalSP\Constants\Requests\HeaderConstants;
use NotaFiscalSP\Entities\PeriodQueryInformation;
use NotaFiscalSP\Helpers\General;

class RequestEntitiesFactory{
    public static function makePeriodQuery( $params){
        $queryInformation = new PeriodQueryInformation();
        $queryInformation->setCnpj(General::param($params, HeaderConstants::CNPJ));
        $queryInformation->setStartDate(General::param($params, HeaderConstants::START_DATE));
        $queryInformation->setEndDate(General::param($params, HeaderConstants::END_DATE));
        $queryInformation->setPage(General::param($params, HeaderConstants::PAGE));
        return $queryInformation;
    }
}