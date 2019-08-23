<?php

namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\DetailValidator;

class PedidoConsultaNFe extends NfAbstract
{

    public function makeXmlRequest(BaseInformation $information, $documents)
    {
        $documents = DetailValidator::queryDetail($information, $documents);
        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true
        ]);
        $detail = $this->makeDetail($information, $documents);

        $request = array_merge($header, $detail);

        return Xml::makeRequestXML(NfMethods::CONSULTA, $request);
    }

}