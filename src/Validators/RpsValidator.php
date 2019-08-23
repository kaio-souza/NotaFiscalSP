<?php

namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\Requests\ComplexFieldsEnum;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\Rps;
use NotaFiscalSP\Helpers\Certificate;

class RpsValidator
{
    public static function validateRps(BaseInformation $baseInformation, $rps)
    {
        $rpsOK = [];

        if ($rps instanceof Rps)
            $rps = [$rps];

        foreach ($rps as $item) {
            $item = $item->toArray();

            if (empty($item[SimpleFieldsEnum::IM_PROVIDER]))
                $item[SimpleFieldsEnum::IM_PROVIDER] = $baseInformation->getIm();

            $item[RpsEnum::ISS_RETENTION] = $item[RpsEnum::ISS_RETENTION] ? 'true' : 'false';

            $item[ComplexFieldsEnum::RPS_KEY] = true;
            $item[DetailEnum::SIGN] = Certificate::rpsSignatureString($item);
            $rpsOK[] = $item;
        }
        return $rpsOK;
    }
}