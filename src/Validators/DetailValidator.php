<?php
namespace NotaFiscalSP\Validators;

use mysql_xdevapi\Exception;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Exceptions\RequiredDataMissing;
use NotaFiscalSP\Helpers\General;

class DetailValidator
{
    public static function queryDetail(BaseInformation $baseInformation, $params){

        if (!is_array(General::getPath($params, '0'))){
            $params = [$params];
        }
        foreach ($params as $key => $document){
            if(
                !General::getKey($document, SimpleFieldsConstants::NFE_NUMBER) &&
                !General::getKey($document, SimpleFieldsConstants::RPS_NUMBER)
            ){
                throw new RequiredDataMissing(SimpleFieldsConstants::NFE_NUMBER.' or '.SimpleFieldsConstants::RPS_NUMBER);
            }

            if(!General::getKey($document, SimpleFieldsConstants::IM_PROVIDER)){
                $params[$key][SimpleFieldsConstants::IM_PROVIDER] = $baseInformation->getIm();
            }
        }
        return $params;
    }
}