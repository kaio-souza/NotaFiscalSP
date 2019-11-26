<?php

namespace NotaFiscalSP\Builders\Responses;

use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Responses\CnpjInformationResponse;

class CnpjInformationFactory extends AbstractResponse
{

    public function __construct()
    {
        $this->response = new CnpjInformationResponse();
    }

    public function make($input, $output)
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
        $details = $this->arrayResponse['Detalhe'];
        if(count($details) > 2){
            foreach ($details as $detail){
                if(General::getPath($detail, 'EmiteNFe') == 'true'){
                    return General::getPath($detail, 'InscricaoMunicipal');
                }
            }
        }else{
            return General::getPath($details, 'InscricaoMunicipal');
        }
    }

    public function getStatus()
    {
        return General::getPath($this->arrayResponse, 'Detalhe');
    }


}
