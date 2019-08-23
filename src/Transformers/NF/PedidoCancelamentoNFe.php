<?php

namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\DetailValidator;

class PedidoCancelamentoNFe extends NfAbstract
{

    public function makeXmlRequest(BaseInformation $information, $documents)
    {
        $documents = DetailValidator::queryDetail($information, $documents);
        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true,
            HeaderEnum::TRANSACTION => 'false'
        ]);

        foreach ($documents as $key => $document) {
            $documents[$key][DetailEnum::CANCELLATION_SIGN] = Certificate::cancelSignatureString($document);
        }
        $detail = $this->makeDetail($information, $documents);

        $request = array_merge($header, $detail);

        return Xml::makeRequestXML(NfMethods::CANCELAMENTO, $request);
    }
}
