<?php

namespace NotaFiscalSP\Builders\NF;

use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;

class  PedidoInformacoesLote extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $im = null)
    {
        $im = !empty($im) ? $im : $information->getIm();

        $request = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true,
            SimpleFieldsEnum::IM_PROVIDER => $im,

        ]);

        return Xml::makeRequestXML('InformacoesLote', $request);
    }

}