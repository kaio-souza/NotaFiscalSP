<?php
namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\FieldData\BooleanFields;
use NotaFiscalSP\Constants\FieldData\RPSStatus;
use NotaFiscalSP\Constants\FieldData\RPSTaxType;
use NotaFiscalSP\Constants\FieldData\RPSType;
use NotaFiscalSP\Constants\Requests\ComplexFieldsConstants;
use NotaFiscalSP\Constants\Requests\DetailConstants;
use NotaFiscalSP\Constants\Requests\RpsConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\Rps;
use NotaFiscalSP\Helpers\Certificate;

class RpsValidator
{
    public static function validateRps(BaseInformation $baseInformation, $rps){
        if($rps instanceof Rps)
            $rps = $rps->getArray();

        if(empty($rps[SimpleFieldsConstants::IM_PROVIDER]))
            $rps[SimpleFieldsConstants::IM_PROVIDER] = $baseInformation->getIm();

        $rps[RpsConstants::ISS_RETENTION] = $rps[RpsConstants::ISS_RETENTION] ? 'true' : 'false';

        $rps[ComplexFieldsConstants::RPS_KEY] = true;
        $rps[DetailConstants::SIGN] = Certificate::rpsSignatureString($rps);
        return $rps;
    }
}