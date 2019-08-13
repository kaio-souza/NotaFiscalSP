<?php
namespace NotaFiscalSP\Factories;

use NotaFiscalSP\Constants\Requests\PeriodQueryConstants;
use NotaFiscalSP\Entities\PeriodQueryInformation;
use NotaFiscalSP\Helpers\General;

class RequestEntitiesFactory{
    public static function makePeriodQuery( $params){
        $queryInformation = new PeriodQueryInformation();
        $queryInformation->setCnpj(General::param($params, PeriodQueryConstants::CNPJ));
        $queryInformation->setStartDate(General::param($params, PeriodQueryConstants::START_DATE));
        $queryInformation->setEndDate(General::param($params, PeriodQueryConstants::END_DATE));
        $queryInformation->setPage(General::param($params, PeriodQueryConstants::PAGE));
        return $queryInformation;
    }
}