<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\WsdlBase;
use NotaFiscalSP\Factories\Responses\CnpjInformationFactory;
use NotaFiscalSP\Transformers\NF\PedidoConsultaCNPJ;

class NfService
{
    public function checkCNPJ(BaseInformation $baseInformation)
    {
        $transformer = new PedidoConsultaCNPJ;
        $file = $transformer->makeXmlRequest($baseInformation);
        $baseInformation->setXml($file);
        $output = ApiClient::send($this->nfEndPoint(), NfMethods::CONSULTA_CNPJ, $baseInformation);
        $response = new CnpjInformationFactory();
        return $response->transform($baseInformation->getXml(), $output);
    }

    public function nfEndPoint()
    {
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF);
        return $baseInformation;
    }

    // Complementar Information
    public function nfAsyncEndPoint()
    {
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF_ASYNC);
        return $baseInformation;
    }
}