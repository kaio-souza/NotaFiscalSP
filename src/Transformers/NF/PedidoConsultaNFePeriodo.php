<?php

namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;

class  PedidoConsultaNFePeriodo extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params)
    {
        $extra = [
            HeaderEnum::CPFCNPJ_SENDER => true,
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