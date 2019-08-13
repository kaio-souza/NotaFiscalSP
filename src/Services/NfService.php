<?php
namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\NfMethods;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\WsdlBase;
use NotaFiscalSP\Factories\RequestEntitiesFactory;
use NotaFiscalSP\Transformers\NF\PedidoConsultaCNPJ;
use NotaFiscalSP\Transformers\Responses\CnpjInformationTransformerResponse;

class NfService{
    public function checkCNPJ(BaseInformation $baseInformation){
        $file = PedidoConsultaCNPJ::makeXmlRequest($baseInformation);
        $baseInformation->setXml($file);
        $output= ApiClient::send($this->nfEndPoint(),NfMethods::CONSULTA_CNPJ, $baseInformation);
        $response = new CnpjInformationTransformerResponse();
        return $response->transform($baseInformation->getXml(), $output);
    }

    public function  checkPeriod(BaseInformation $baseInformation, $params){
        $queryInformation = RequestEntitiesFactory::makePeriodQuery($params);
        $file =  PedidoConsultaNFePeriodo::makeXmlRequest($baseInformation, $queryInformation);
        $baseInformation->setXml($file);

        return ApiClient::send($this->nfEndPoint(),NfMethods::CONSULTA_NFE_PERIODO, $baseInformation);
    }

    // Complementar Information
    public function nfEndPoint(){
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF);
        return $baseInformation;
    }

    public function nfAsyncEndPoint(){
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF_ASYNC);
        return $baseInformation;
    }
}