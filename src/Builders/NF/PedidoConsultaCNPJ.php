<?php

namespace NotaFiscalSP\Builders\NF;

use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;

class  PedidoConsultaCNPJ extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params = null)
    {

        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true
        ]);
        if(isset($params['document'])){
            $taxPayer = $this->makeTaxPayerInformation(General::onlyNumbers($params['document']));
        }else{
            $taxPayer = $this->makeTaxPayerInformation($information->getCnpj()? $information->getCnpj() : $information->getCpf());
        }
        $request = array_merge($header, $taxPayer);

        return Xml::makeRequestXML(NfMethods::CONSULTA_CNPJ, $request);
    }
}