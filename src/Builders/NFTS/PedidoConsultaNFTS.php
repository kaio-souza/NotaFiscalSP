<?php

namespace NotaFiscalSP\Builders\NFTS;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Builders\NftsAbstract;
use NotaFiscalSP\Validators\DetailValidator;

class  PedidoConsultaNFTS extends NftsAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params)
    {
        $params = DetailValidator::queryDetail($information, $params);
        $header = $this->makeHeader($information, [
            HeaderEnum::SENDER => true,
        ]);

        $detail = $this->makeDetail($information, $params);
        $request = array_merge($header, $detail);
        return Xml::makeNFTSRequestXML(NftsMethods::CONSULTA, $request);
    }

}