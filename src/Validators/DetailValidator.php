<?php

namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Exceptions\RequiredDataMissing;
use NotaFiscalSP\Helpers\General;

class DetailValidator
{
    public static function queryDetail(BaseInformation $baseInformation, $params)
    {

        if (!is_array(General::getPath($params, '0'))) {
            $params = [$params];
        }
        foreach ($params as $key => $document) {
            if (
                !General::getKey($document, SimpleFieldsEnum::NFE_NUMBER) &&
                !General::getKey($document, SimpleFieldsEnum::RPS_NUMBER)
            ) {
                throw new RequiredDataMissing(SimpleFieldsEnum::NFE_NUMBER . ' or ' . SimpleFieldsEnum::RPS_NUMBER);
            }

            if (!General::getKey($document, SimpleFieldsEnum::IM_PROVIDER)) {
                $params[$key][SimpleFieldsEnum::IM_PROVIDER] = $baseInformation->getIm();
            }
        }
        return $params;
    }
}