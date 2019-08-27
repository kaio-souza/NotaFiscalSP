<?php

namespace NotaFiscalSP\Builders\NFTS;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Builders\NfAbstract;
use NotaFiscalSP\Builders\NftsAbstract;

class  PedidoConsultaLoteNFTS extends NftsAbstract
{
    public function makeXmlRequest(BaseInformation $information, $lot)
    {
        $header = $this->makeHeader($information, [
            HeaderEnum::SENDER => true,
        ]);

        $request = array_merge($header, [
            DetailEnum::DETAIL_LOT => $lot
        ]);
        return Xml::makeNFTSRequestXML(NftsMethods::CONSULTA_LOTE, $request);
    }

}