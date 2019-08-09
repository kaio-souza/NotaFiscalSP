<?php
namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\NfsMethods;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\WsdlBase;
use NotaFiscalSP\Transformers\NFS\CnpjInformation;

class NfsService{
    public function checkCNPJ(BaseInformation $baseInformation){
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