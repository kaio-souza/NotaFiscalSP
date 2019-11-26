<?php

namespace NotaFiscalSP\Builders\NFTS;

use NotaFiscalSP\Builders\NftsAbstract;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Validators\NftsValidator;

class PedidoEnvioLoteNFTS extends NftsAbstract
{

    public function makeXmlRequest(BaseInformation $information, $lot)
    {
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