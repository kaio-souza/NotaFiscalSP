<?php

namespace NotaFiscalSP\Builders\NFTS;

use NotaFiscalSP\Builders\NftsAbstract;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Validators\DetailValidator;

class PedidoCancelamentoNFTS extends NftsAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params)
    {
        $params = DetailValidator::queryDetail($information, $params);
        $header = $this->makeHeader($information, [
            HeaderEnum::SENDER => true,
            HeaderEnum::TRANSACTION => 'false'
        ]);

        foreach ($params as $key => $document) {
            $params[$key][DetailEnum::CANCELLATION_SIGN] = Certificate::cancelSignatureString($document);
        }

        $detail = $this->makeDetail($information, $params);

        $request = array_merge($header, $detail);

        return Xml::makeNFTSRequestXML(NfMethods::CANCELAMENTO, $request);
    }
}