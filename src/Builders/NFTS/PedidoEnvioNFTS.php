<?php

namespace NotaFiscalSP\Builders\NFTS;

use NotaFiscalSP\Builders\NftsAbstract;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Validators\NftsValidator;

class PedidoEnvioNFTS extends NftsAbstract
{
    public function makeXmlRequest(BaseInformation $information, $rps)
    {
        $documents = NftsValidator::validateRequest($information, $rps);
        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true
        ]);
        $allNfts = $this->makeNFTS($information, $documents);

        $request = array_merge($header, $allNfts);

        return Xml::makeRequestXML(NftsMethods::ENVIO, $request);
    }
}