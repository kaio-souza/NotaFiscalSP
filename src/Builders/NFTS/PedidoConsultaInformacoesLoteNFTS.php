<?php

namespace NotaFiscalSP\Builders\NFTS;

use NotaFiscalSP\Builders\NftsAbstract;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Xml;

class  PedidoConsultaInformacoesLoteNFTS extends NftsAbstract
{
    public function makeXmlRequest(BaseInformation $information, $lot)
    {
        $header = $this->makeHeader($information, [
            HeaderEnum::SENDER => true,
        ]);

        $request = array_merge($header, [
            DetailEnum::DETAIL_LOT_INFORMATION => $lot
        ]);
        return Xml::makeNFTSRequestXML(NftsMethods::CONSULTA_INFORMACOES_LOTE, $request);
    }

}