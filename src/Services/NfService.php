<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\Methods\NfAsyncMethods;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Contracts\OutputClass;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Factories\Responses\BasicTransformerResponse;
use NotaFiscalSP\Factories\Responses\CnpjInformationFactory;
use NotaFiscalSP\Factories\WsdlFactory;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Transformers\AsyncNF\PedidoConsultaGuia;
use NotaFiscalSP\Transformers\AsyncNF\PedidoConsultaSituacaoGuia;
use NotaFiscalSP\Transformers\AsyncNF\PedidoConsultaSituacaoLote;
use NotaFiscalSP\Transformers\AsyncNF\PedidoEmissaoGuiaAsync;
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
    private $nfEndPoint;
    private $nfAsyncEndPoint;

    public function __construct()
    {
        $this->nfEndPoint = WsdlFactory::make(Endpoints::NF);
        $this->nfAsyncEndPoint = WsdlFactory::make(Endpoints::NF_ASYNC);
        $this->response = new BasicTransformerResponse();
    }

    /*
     *  NF METHODS
     */
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
        $output = ApiClient::send($this->nfEndPoint, $method, $information);

        // Return Response with signed Input and Output
        return isset($output->success) ? $output : $outputClass->make($information->getXml(), $output);
    }

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
        $lot = [HeaderEnum::LOT_NUMBER => $lotNumber];
        $transformer = new PedidoConsultaLote();
        return $this->processRequest($baseInformation, $lot, NfMethods::CONSULTA_LOTE, $transformer);
    }

    public function cancelNf(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoCancelamentoNFe();
        return $this->processRequest($baseInformation, $params, NfMethods::CANCELAMENTO, $transformer);
    }

    public function sendNf(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEnvioRPS();
        return $this->processRequest($baseInformation, $params, NfMethods::ENVIO, $transformer);
    }

    public function sendLot(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEnvioLoteRPS();
        return $this->processRequest($baseInformation, $params, NfMethods::ENVIO_LOTE, $transformer);
    }

    public function testSendLot(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEnvioLoteRPS();
        return $this->processRequest($baseInformation, $params, NfMethods::TESTE_ENVIO_LOTE, $transformer);
    }

    public function getIssued(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaNFePeriodo();
        return $this->processRequest($baseInformation, $params, NfMethods::CONSULTA_NFE_EMITIDAS, $transformer);
    }

    //  NF ASYNC METHODS

    public function getReceived(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaNFePeriodo();
        return $this->processRequest($baseInformation, $params, NfMethods::CONSULTA_NFE_RECEBIDAS, $transformer);
    }

    public function testSendAsyncLot(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEnvioLoteRPS();
        return $this->processAsyncRequest($baseInformation, $params, NfAsyncMethods::TESTE_ENVIO_LOTE, $transformer);
    }

    private function processAsyncRequest(BaseInformation $information, $params, $method, InputTransformer $transformer, OutputClass $outputClass = null)
    {
        // Check Output Type
        $outputClass = !empty($outputClass) ? $outputClass : $this->response;
        $params = General::convertUserRequest($params);

        //  File Without Signature
        $file = $transformer->makeXmlRequest($information, $params);
        //Set Input file and sign
        $information->setXml($file);

        // Send to API,
        $output = ApiClient::send($this->nfAsyncEndPoint, $method, $information);

        // Return Response with signed Input and Output
        return isset($output->success) ? $output : $outputClass->make($information->getXml(), $output);
    }

    public function sendAsyncLot(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEnvioLoteRPS();
        return $this->processAsyncRequest($baseInformation, $params, NfAsyncMethods::ENVIO_LOTE, $transformer);
    }

    public function checkAsyncLot(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaSituacaoLote();
        return $this->processAsyncRequest($baseInformation, $params, NfAsyncMethods::CONSULTA_SITUACAO_LOTE, $transformer);
    }

    public function checkReceipt(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaGuia();
        return $this->processAsyncRequest($baseInformation, $params, NfAsyncMethods::CONSULTA_GUIA, $transformer);
    }

    // Process Requests

    public function checkReceiptSituation(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaSituacaoGuia();
        return $this->processAsyncRequest($baseInformation, $params, NfAsyncMethods::CONSULTA_SITUACAO_GUIA, $transformer);
    }

    public function makeReceiptAsync(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoEmissaoGuiaAsync();
        return $this->processAsyncRequest($baseInformation, $params, NfAsyncMethods::EMISSAO_GUIA_ASYNC, $transformer);
    }

}