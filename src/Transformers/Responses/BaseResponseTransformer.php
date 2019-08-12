<?php
namespace NotaFiscalSP\Transformers\Responses;

use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Responses\BasicResponse;

class BaseResponseTransformer{
    private $baseResponse;
    public function __construct()
    {
        $this->baseResponse = new BasicResponse();
    }

    public function transform($input, $output){
        $this->baseResponse->setXmlInput($input);
        $this->baseResponse->setXmlOutput($output);
        $response = Xml::toArray($output);
        return($this->baseResponse);
    }

}
