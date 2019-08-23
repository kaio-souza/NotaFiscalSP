<?php

namespace NotaFiscalSP\Transformers\AsyncNF;

use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;

class  PedidoEmissaoGuiaAsync extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params = null)
    {
        $request = [];
        $request[HeaderEnum::CPFCNPJ_SENDER] = [SimpleFieldsEnum::CNPJ => $information->getCnpj()];
        $request[SimpleFieldsEnum::IM_PROVIDER] = $information->getIm();
        $request[SimpleFieldsEnum::EMISSION_TYPE] = General::getKey($params, SimpleFieldsEnum::EMISSION_TYPE);
        $request[SimpleFieldsEnum::INCIDENCE] = General::getKey($params, SimpleFieldsEnum::INCIDENCE);
        $request[SimpleFieldsEnum::PAYMENT_DATE] = General::getKey($params, SimpleFieldsEnum::PAYMENT_DATE);

        return Xml::makeRequestXML('EmissaoGuia', $request);
    }
}