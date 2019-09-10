<?php

namespace NotaFiscalSP\Builders\AsyncNF;

use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Constants\Methods\NfAsyncMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;

class  PedidoConsultaSituacaoLote extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params = null)
    {
        $request = [];
        $request[HeaderEnum::CPFCNPJ_SENDER] = [SimpleFieldsEnum::CNPJ => $information->getCnpj()];
        $request[SimpleFieldsEnum::PROTOCOL_NUMBER] = General::getKey($params, SimpleFieldsEnum::PROTOCOL_NUMBER);

        return Xml::makeRequestXML(NfAsyncMethods::CONSULTA_SITUACAO_LOTE, $request);
    }
}