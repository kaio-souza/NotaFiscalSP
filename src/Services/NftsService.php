<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Entities\WsdlBase;

class NftsService{


    public function nftsEndPoint(){
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NFTS);
        return $baseInformation;
    }
}