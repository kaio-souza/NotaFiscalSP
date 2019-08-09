<?php
namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\NfsMethods;
use NotaFiscalSP\Entities\WsdlBase;
use NotaFiscalSP\Transformers\CnpjInformation;

class NfsService{
    public function checkCNPJ($baseInformation){
        $file = CnpjInformation::makeXmlRequest($baseInformation);
        $baseInformation->setXml($file);
        return ApiClient::send($this->nfsEndPoint(),NfsMethods::CONSULTA_CNPJ, $baseInformation);
    }


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