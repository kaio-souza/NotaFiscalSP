<?php

namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\NFTS\Nfts;

class NftsValidator
{
    public static function validateRequest(BaseInformation $baseInformation, $nfts2)
    {
        $nftsOk = [];

        $nfts = !array_key_exists(0, $nfts2) ? [$nfts2] : $nfts2 ;

        foreach ($nfts as $item) {
            if($item instanceof Nfts){
              $item = $item->toArray();
            }

            if (empty($item[NftsEnum::IM]))
                $item[NftsEnum::IM] = $baseInformation->getIm();

            $item[NftsEnum::DOCUMENT_KEY] = true;
            $nftsOk[] = $item;
        }
        return $nftsOk;
    }
}