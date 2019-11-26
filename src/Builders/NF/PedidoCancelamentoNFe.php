<?php

namespace NotaFiscalSP\Builders\NF;

use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Validators\DetailValidator;

class PedidoCancelamentoNFe extends NfAbstract
{

    public function makeXmlRequest(BaseInformation $information, $params)
    {
        $params = DetailValidator::queryDetail($information, $params);
        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true,
            HeaderEnum::TRANSACTION => 'false'
        ]);

        foreach ($params as $key => $document) {
            $params[$key][DetailEnum::CANCELLATION_SIGN] = Certificate::cancelSignatureString($document);
        }
        $detail = $this->makeDetail($information, $params);

        $request = array_merge($header, $detail);

        return Xml::makeRequestXML(NfMethods::CANCELAMENTO, $request);
    }
}
