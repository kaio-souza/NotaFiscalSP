<?php

namespace NotaFiscalSP\Transformers\NFTS;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Transformers\NftsAbstract;
use NotaFiscalSP\Validators\DetailValidator;

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