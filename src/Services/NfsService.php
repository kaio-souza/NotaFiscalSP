<?php
namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\NfsAsyncMethods;
use NotaFiscalSP\Constants\NfsMethods;
use NotaFiscalSP\Constants\NftsMethods;
use NotaFiscalSP\Constants\Requests\PeriodQueryConstants;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\PeriodQueryInformation;
use NotaFiscalSP\Entities\WsdlBase;
use NotaFiscalSP\Factories\RequestEntitiesFactory;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Transformers\NFS\PedidoConsultaCNPJ;
use NotaFiscalSP\Transformers\NFS\PedidoConsultaNFePeriodo;
use NotaFiscalSP\Transformers\Responses\CnpjInformationTransformerResponse;


class NfsService{
    public function checkCNPJ(BaseInformation $baseInformation){
        $file = PedidoConsultaCNPJ::makeXmlRequest($baseInformation);
        $baseInformation->setXml($file);
        $output= ApiClient::send($this->nfsEndPoint(),NfsMethods::CONSULTA_CNPJ, $baseInformation);
        $response = new CnpjInformationTransformerResponse();
        return $response->transform($baseInformation->getXml(), $output);
    }

    public function  checkPeriod(BaseInformation $baseInformation, $params){
        $queryInformation = RequestEntitiesFactory::makePeriodQuery($params);
        $file =  PedidoConsultaNFePeriodo::makeXmlRequest($baseInformation, $queryInformation);
        $baseInformation->setXml($file);

        return ApiClient::send($this->nfsEndPoint(),NfsMethods::CONSULTA_NFE_PERIODO, $baseInformation);
    }

    // Complementar Information
    public function nfsEndPoint(){
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NFS);
        return $baseInformation;
    }

    public function nfsAsyncEndPoint(){
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NFS_ASYNC);
        return $baseInformation;
    }
}