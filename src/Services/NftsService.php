<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Factories\Responses\BasicTransformerResponse;
use NotaFiscalSP\Factories\WsdlFactory;

class NftsService
{
    public $response;
    private $endPoint;

    public function __construct()
    {
        $this->endPoint = WsdlFactory::make(Endpoints::NFTS);;
        $this->response = new BasicTransformerResponse();
    }


}