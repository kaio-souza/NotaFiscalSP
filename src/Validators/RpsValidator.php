<?php
namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\FieldData\BooleanFields;
use NotaFiscalSP\Constants\FieldData\RPSStatus;
use NotaFiscalSP\Constants\FieldData\RPSTaxType;
use NotaFiscalSP\Constants\FieldData\RPSType;
use NotaFiscalSP\Constants\Requests\ComplexFieldsEnum;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\Rps;
use NotaFiscalSP\Helpers\Certificate;

class RpsValidator
{
    public static function validateRps(BaseInformation $baseInformation, $rps){
        if($rps instanceof Rps)
            $rps = $rps->toArray();

        if(empty($rps[SimpleFieldsEnum::IM_PROVIDER]))
            $rps[SimpleFieldsEnum::IM_PROVIDER] = $baseInformation->getIm();

        $rps[RpsEnum::ISS_RETENTION] = $rps[RpsEnum::ISS_RETENTION] ? 'true' : 'false';

        $rps[ComplexFieldsEnum::RPS_KEY] = true;
        $rps[DetailEnum::SIGN] = Certificate::rpsSignatureString($rps);
        return $rps;
    }
}