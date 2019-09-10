<?php

namespace NotaFiscalSP\Builders\NF;

use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;

class  PedidoConsultaLote extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $lot)
    {

        $request = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true,
            HeaderEnum::LOT_NUMBER => $lot[HeaderEnum::LOT_NUMBER]
        ]);
        return Xml::makeRequestXML(NfMethods::CONSULTA_LOTE, $request);
    }

}