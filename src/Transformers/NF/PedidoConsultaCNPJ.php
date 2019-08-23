<?php

namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;

class  PedidoConsultaCNPJ extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params = null)
    {

        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true
        ]);
        $taxPayer = $this->makeTaxPayerInformation($information->getCnpj());
        $request = array_merge($header, $taxPayer);

        return Xml::makeRequestXML(NfMethods::CONSULTA_CNPJ, $request);
    }
}