<?php

namespace NotaFiscalSP\Factories\Responses;

use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Responses\CnpjInformationResponse;

class CnpjInformationFactory extends AbstractResponse
{

    public function __construct()
    {
        $this->response = new CnpjInformationResponse();
    }

    public function transform($input, $output)
    {
        $this->response->setXmlInput($input);
        $this->response->setXmlOutput($output);

        $this->arrayResponse = Xml::toArray($output);
        $this->response->setIm($this->getIm());
        $this->response->setSuccess($this->checkSuccess());
        $this->response->setStatus($this->getStatus());
        return $this->response;
    }

    public function getIm()
    {
        return General::param($this->arrayResponse, 'Detalhe.InscricaoMunicipal');
    }

    public function getStatus()
    {
        return General::param($this->arrayResponse, 'Detalhe.EmiteNFe');
    }


}
