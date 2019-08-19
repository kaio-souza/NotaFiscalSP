<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Contracts\OutputClass;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\WsdlBase;
use NotaFiscalSP\Factories\Responses\BasicTransformerResponse;
use NotaFiscalSP\Factories\Responses\CnpjInformationFactory;
use NotaFiscalSP\Transformers\NF\PedidoConsultaCNPJ;
use NotaFiscalSP\Transformers\NF\PedidoConsultaNFe;

class NfService
{
    public $response;

    public function __construct()
    {
        $this->response = new BasicTransformerResponse();
    }

    public function checkCNPJ(BaseInformation $baseInformation)
    {
        $transformer = new PedidoConsultaCNPJ;
        $outputClass = new CnpjInformationFactory;
        return $this->proccessRequest($baseInformation, [], NfMethods::CONSULTA_CNPJ, $transformer, $outputClass);
    }

    private function proccessRequest(BaseInformation $information, $params, $method, InputTransformer $transformer, OutputClass $outputClass = null)
    {
        // Check Output Type
        $outputClass = !empty($outputClass) ? $outputClass : $this->response;

        //  File Without Signature
        $file = $transformer->makeXmlRequest($information, $params);

        //Set Input file and sign
        $information->setXml($file);


        // Send to API
        $output = ApiClient::send($this->nfEndPoint(), $method, $information);

        // Return Response with signed Input and Output
        return $outputClass->make($information->getXml(), $output);
    }

    public function nfEndPoint()
    {
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF);
        return $baseInformation;
    }

    // Complementar Information

    public function checkNfs(BaseInformation $baseInformation, $params)
    {
        if (!isset($params[SimpleFieldsConstants::IM_PROVIDER]))
            $params[SimpleFieldsConstants::IM_PROVIDER] = $baseInformation->getIm();

        $transformer = new PedidoConsultaNFe();
        return $this->proccessRequest($baseInformation, $params, NfMethods::CONSULTA, $transformer);
    }

    public function nfAsyncEndPoint()
    {
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF_ASYNC);
        return $baseInformation;
    }
}