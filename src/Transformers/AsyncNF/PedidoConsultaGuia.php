<?php

namespace NotaFiscalSP\Transformers\AsyncNF;

use NotaFiscalSP\Constants\Methods\NfAsyncMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;

class  PedidoConsultaGuia extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params = null)
    {
        $request = [];
        $request[HeaderEnum::CPFCNPJ_SENDER] = [SimpleFieldsEnum::CNPJ => $information->getCnpj()];
        $request[SimpleFieldsEnum::IM_PROVIDER] = $information->getIm();
        $request[SimpleFieldsEnum::INCIDENCE] = General::getKey($params, SimpleFieldsEnum::INCIDENCE);
        $request[SimpleFieldsEnum::SITUATION] = General::getKey($params, SimpleFieldsEnum::SITUATION);

        return Xml::makeRequestXML(NfAsyncMethods::CONSULTA_GUIA, $request);
    }
}