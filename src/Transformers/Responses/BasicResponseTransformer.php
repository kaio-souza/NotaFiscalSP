<?php
namespace NotaFiscalSP\Transformers\Responses;

use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Responses\BasicResponse;

class BasicResponseTransformer{
    private $basicResponse;
    public function __construct()
    {
        $this->basicResponse = new BasicResponse();
    }

    public function transform($input, $output){
        $this->basicResponse->setXmlInput($input);
        $this->basicResponse->setXmlOutput($output);

        $response = Xml::toArray($output);
        $this->basicResponse->setResponse($response);
        $this->basicResponse->setSuccess($this->checkSuccess($response));
        return($this->basicResponse);
    }

    public function checkSuccess($response){
        return true;

    }

}
