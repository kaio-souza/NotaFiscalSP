<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Builders\NFTS\PedidoCancelamentoNFTS;
use NotaFiscalSP\Builders\NFTS\PedidoConsultaEmissaoNFSE;
use NotaFiscalSP\Builders\NFTS\PedidoConsultaInformacoesLoteNFTS;
use NotaFiscalSP\Builders\NFTS\PedidoConsultaLoteNFTS;
use NotaFiscalSP\Builders\NFTS\PedidoConsultaNFTS;
use NotaFiscalSP\Builders\NFTS\PedidoEnvioLoteNFTS;
use NotaFiscalSP\Builders\NFTS\PedidoEnvioNFTS;
use NotaFiscalSP\Builders\Responses\BasicTransformerResponse;
use NotaFiscalSP\Builders\WsdlBuilder;
use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Contracts\OutputClass;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;

class NftsService
{
    public $response;
    private $endPoint;

    public function __construct()
    {
        $this->endPoint = WsdlBuilder::make(Endpoints::NFTS);;
        $this->response = new BasicTransformerResponse();
    }

    public function getNfts(BaseInformation $baseInformation, $params)
    {
        $builder = new PedidoConsultaNFTS();
        return $this->processRequest($baseInformation, $params, NftsMethods::CONSULTA, $builder);
    }

    private function processRequest(BaseInformation $information, $params, $method, InputTransformer $builder, OutputClass $outputClass = null)
    {
        // Check Output Type
        $outputClass = !empty($outputClass) ? $outputClass : $this->response;

        $params = General::convertUserRequest($params);

        //  File Without Signature
        $file = $builder->makeXmlRequest($information, $params);

        //Set Input file and sign
        $information->setXml($file);

        // Send to API
        $output = ApiClient::send($this->endPoint, $method, $information);

        // Return Response with signed Input and Output
        return isset($output->success) ? $output : $outputClass->make($information->getXml(), $output);
    }

    public function lotInformation(BaseInformation $baseInformation, $lotNumber)
    {
        $lot = [HeaderEnum::LOT_NUMBER => $lotNumber];
        $builder = new PedidoConsultaInformacoesLoteNFTS();
        return $this->processRequest($baseInformation, $lot, NftsMethods::CONSULTA_INFORMACOES_LOTE, $builder);
    }

    public function getLot(BaseInformation $baseInformation, $lotNumber)
    {
        $lot = [HeaderEnum::LOT_NUMBER => $lotNumber];
        $builder = new PedidoConsultaLoteNFTS();
        return $this->processRequest($baseInformation, $lot, NftsMethods::CONSULTA_LOTE, $builder);
    }

    public function checkEmission(BaseInformation $baseInformation, $params)
    {
        if ($params instanceof UserRequest)
            $params = $params->toArray();

        $builder = new PedidoConsultaEmissaoNFSE();
        return $this->processRequest($baseInformation, $params, NftsMethods::CONSULTA_AUT_EMISSAO, $builder);
    }

    public function testLotNfts(BaseInformation $baseInformation, $params)
    {
        $builder = new PedidoEnvioLoteNFTS();
        return $this->processRequest($baseInformation, $params, NftsMethods::TESTE_ENVIO_LOTE, $builder);
    }

    public function lotNfts(BaseInformation $baseInformation, $params)
    {
        $builder = new PedidoEnvioLoteNFTS();
        return $this->processRequest($baseInformation, $params, NftsMethods::ENVIO_LOTE, $builder);
    }

    public function sendNfts(BaseInformation $baseInformation, $params)
    {
        $builder = new PedidoEnvioNFTS();
        return $this->processRequest($baseInformation, $params, NftsMethods::ENVIO, $builder);
    }

    public function cancelNfts(BaseInformation $baseInformation, $params)
    {
        $builder = new PedidoCancelamentoNFTS();
        return $this->processRequest($baseInformation, $params, NftsMethods::ENVIO, $builder);
    }
}