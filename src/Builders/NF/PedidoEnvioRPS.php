<?php

namespace NotaFiscalSP\Builders\NF;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Validators\RpsValidator;

class PedidoEnvioRPS extends NfAbstract
{

    public function makeXmlRequest(BaseInformation $information, $rps)
    {
        $documents = RpsValidator::validateRps($information, $rps);
        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true
        ]);
        $allRps = $this->makeRPS($information, $documents);

        $request = array_merge($header, $allRps);

        return Xml::makeRequestXML(NfMethods::ENVIO, $request);
    }

}