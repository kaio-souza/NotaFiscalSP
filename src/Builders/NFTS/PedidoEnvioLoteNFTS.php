<?php

namespace NotaFiscalSP\Builders\NF;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\NF\Lot;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Builders\NftsAbstract;
use NotaFiscalSP\Validators\NftsValidator;
use NotaFiscalSP\Validators\RpsValidator;

class PedidoEnvioLoteNFTS extends NftsAbstract
{

    public function makeXmlRequest(BaseInformation $information, $lot)
    {
        if ($lot instanceof Lot)
            $lot = $lot->toArray();

        $documents = NftsValidator::validateRequest($information, General::getKey($lot, NftsEnum::NFTS));
        $header = $this->makeHeader($information, [
            HeaderEnum::SENDER => true,
            HeaderEnum::TRANSACTION => General::getKey($lot, HeaderEnum::TRANSACTION),
            HeaderEnum::START_DATE => General::getKey($lot, HeaderEnum::START_DATE),
            HeaderEnum::END_DATE => General::getKey($lot, HeaderEnum::END_DATE),
            HeaderEnum::NFTS_COUNT => General::getKey($lot, HeaderEnum::NFTS_COUNT),
            HeaderEnum::SERVICES_TOTAL => General::getKey($lot, HeaderEnum::SERVICES_TOTAL),
            HeaderEnum::DEDUCTION_TOTAL => General::getKey($lot, HeaderEnum::DEDUCTION_TOTAL),
        ]);
        $allNfts = $this->makeNFTS($information, $documents);

        $request = array_merge($header, $allNfts);

        return Xml::makeNFTSRequestXML(NftsMethods::ENVIO_LOTE, $request);
    }
}