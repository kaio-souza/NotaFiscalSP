<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Contracts\OutputClass;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\UserRequest;
use NotaFiscalSP\Entities\WsdlBase;
use NotaFiscalSP\Factories\Responses\BasicTransformerResponse;
use NotaFiscalSP\Factories\Responses\CnpjInformationFactory;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Transformers\NF\PedidoCancelamentoNFe;
use NotaFiscalSP\Transformers\NF\PedidoConsultaCNPJ;
use NotaFiscalSP\Transformers\NF\PedidoConsultaLote;
use NotaFiscalSP\Transformers\NF\PedidoConsultaNFe;
use NotaFiscalSP\Transformers\NF\PedidoConsultaNFePeriodo;
use NotaFiscalSP\Transformers\NF\PedidoEnvioLoteRPS;
use NotaFiscalSP\Transformers\NF\PedidoEnvioRPS;
use NotaFiscalSP\Transformers\NF\PedidoInformacoesLote;

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
        return $this->processRequest($baseInformation, [], NfMethods::CONSULTA_CNPJ, $transformer, $outputClass);
    }

    private function processRequest(BaseInformation $information, $params, $method, InputTransformer $transformer, OutputClass $outputClass = null)
    {
        // Check Output Type
        $outputClass = !empty($outputClass) ? $outputClass : $this->response;

       $params = General::convertUserRequest($params);

        //  File Without Signature
        $file = $transformer->makeXmlRequest($information, $params);

        //Set Input file and sign
        $information->setXml($file);

        // Send to API,

        $output = ApiClient::send($this->nfEndPoint(), $method, $information);

        // Return Response with signed Input and Output
        return isset($output->success) ? $output : $outputClass->make($information->getXml(), $output)  ;
    }

    // Complementar Information

    public function getNf(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaNFe();
        return $this->processRequest($baseInformation, $params, NfMethods::CONSULTA, $transformer);
    }

    public function lotInformation(BaseInformation $baseInformation, $params = [])
    {
        $transformer = new PedidoInformacoesLote();
        return $this->processRequest($baseInformation, $params, NfMethods::CONSULTA_INFORMACOES_LOTE, $transformer);
    }

    public function getLot(BaseInformation $baseInformation, $lotNumber)
    {
        $transformer = new PedidoConsultaLote();
        return $this->processRequest($baseInformation, $lotNumber, NfMethods::CONSULTA_LOTE, $transformer);
    }


    public function cancelNf(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoCancelamentoNFe();
        return $this->processRequest($baseInformation, $params, NfMethods::CANCELAMENTO, $transformer);
    }

    public function emmit(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEnvioRPS();
        return $this->processRequest($baseInformation, $params, NfMethods::ENVIO, $transformer);
    }

    public function emmitLot(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEnvioLoteRPS();
        return $this->processRequest($baseInformation, $params, NfMethods::ENVIO_LOTE, $transformer);
    }

    public function getIssued(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaNFePeriodo();
        return $this->processRequest($baseInformation, $params, NfMethods::CONSULTA_NFE_EMITIDAS, $transformer);
    }

    public function getReceived(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaNFePeriodo();
        return $this->processRequest($baseInformation, $params, NfMethods::CONSULTA_NFE_RECEBIDAS, $transformer);
    }

    public function nfEndPoint()
    {
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF);
        return $baseInformation;
    }

    public function nfAsyncEndPoint()
    {
        $baseInformation = new WsdlBase();
        $baseInformation->setEndPoint(Endpoints::NF_ASYNC);
        return $baseInformation;
    }
}