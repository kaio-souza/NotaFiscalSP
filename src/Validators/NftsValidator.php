<?php

namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\NFTS\Nfts;

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

            $item[NftsEnum::DOCUMENT_KEY] = true;
            $nftsOk[] = $item;
        }
        return $nftsOk;
    }
}