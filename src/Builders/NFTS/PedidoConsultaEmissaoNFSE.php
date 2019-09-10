<?php

namespace NotaFiscalSP\Builders\NFTS;

use NotaFiscalSP\Builders\NftsAbstract;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;

class  PedidoConsultaEmissaoNFSE extends NftsAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params)
    {

        $header = $this->makeHeader($information, [
            HeaderEnum::SENDER => true,
        ]);

        $detail = $this->makeDetailEmission($information, $params);

        $request = array_merge($header, $detail);

        return Xml::makeNFTSRequestXML('ConsultaEmissaoNFSE', $request);
    }

}