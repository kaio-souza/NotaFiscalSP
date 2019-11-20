<?php

namespace NotaFiscalSP\Builders\NF;

use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;

class  PedidoConsultaNFePeriodo extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params)
    {
        if(isset($params[HeaderEnum::TRANSACTION])){
            unset($params[HeaderEnum::TRANSACTION]);
        }

        $extra = [
            HeaderEnum::CPFCNPJ_SENDER => true,
            HeaderEnum::CPFCNPJ => true
        ];
        if (
            !General::getKey($params, SimpleFieldsEnum::CNPJ) &&
            !General::getKey($params, SimpleFieldsEnum::CPF) &&
            !General::getKey($params, HeaderEnum::IM)
        ) {
            $extra[SimpleFieldsEnum::CNPJ] = $information->getCnpj();
            $extra[HeaderEnum::IM] = $information->getIm();
        }
        $request = $this->makeHeader($information, array_merge($extra, $params));

        return Xml::makeRequestXML(NfMethods::CONSULTA_NFE_PERIODO, $request);
    }

}