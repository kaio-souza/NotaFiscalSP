<?php

namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\Requests\ComplexFieldsEnum;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\NF\Rps;
use NotaFiscalSP\Entities\Requests\NFTS\Nfts;
use NotaFiscalSP\Helpers\Certificate;

class NftsValidator
{
    public static function validateRequest(BaseInformation $baseInformation, $nfts)
    {
        $nftsOk = [];

        if ($nfts instanceof Nfts)
            $nfts = [$nfts];

        foreach ($nfts as $item) {
            $item = $item->toArray();

            if (empty($item[NftsEnum::IM]))
                $item[NftsEnum::IM] = $baseInformation->getIm();

            $item[NftsEnum::ISS_TAKER] = $item[NftsEnum::ISS_TAKER] ? 'true' : 'false';

            if (isset($item[NftsEnum::ISS_INTERMEDIARY]))
                $item[NftsEnum::ISS_INTERMEDIARY] = $item[NftsEnum::ISS_INTERMEDIARY] ? 'true' : 'false';

            $item[NftsEnum::DOCUMENT_KEY] = true;
            $item[DetailEnum::SIGN] = Certificate::rpsSignatureString($item);
            $nftsOk[] = $item;
        }
        return $nftsOk;
    }
}