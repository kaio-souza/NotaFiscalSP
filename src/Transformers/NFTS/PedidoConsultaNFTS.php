<?php

namespace NotaFiscalSP\Transformers\NFTS;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;

class  PedidoConsultaNFTS extends NfAbstract
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