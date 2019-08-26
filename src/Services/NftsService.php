<?php

namespace NotaFiscalSP\Services;

use NotaFiscalSP\Client\ApiClient;
use NotaFiscalSP\Constants\Endpoints;
use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Methods\NftsMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Contracts\OutputClass;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Factories\Responses\BasicTransformerResponse;
use NotaFiscalSP\Factories\WsdlFactory;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Transformers\NF\PedidoConsultaLote;
use NotaFiscalSP\Transformers\NF\PedidoConsultaNFe;
use NotaFiscalSP\Transformers\NF\PedidoInformacoesLote;
use NotaFiscalSP\Transformers\NFTS\PedidoConsultaEmissaoNFSE;
use NotaFiscalSP\Transformers\NFTS\PedidoConsultaInformacoesLoteNFTS;
use NotaFiscalSP\Transformers\NFTS\PedidoConsultaLoteNFTS;
use NotaFiscalSP\Transformers\NFTS\PedidoConsultaNFTS;

class NftsService
{
    public $response;
    private $endPoint;

    public function __construct()
    {
        $this->endPoint = WsdlFactory::make(Endpoints::NFTS);;
        $this->response = new BasicTransformerResponse();
    }

    public function getNfts(BaseInformation $baseInformation, $params)
    {
        $transformer = new PedidoConsultaNFTS();
        return $this->processRequest($baseInformation, $params, NftsMethods::CONSULTA, $transformer);
    }

    public function lotInformation(BaseInformation $baseInformation, $lotNumber)
    {
        $lot = [HeaderEnum::LOT_NUMBER => $lotNumber];
        $transformer = new PedidoConsultaInformacoesLoteNFTS();
        return $this->processRequest($baseInformation, $lot, NftsMethods::CONSULTA_INFORMACOES_LOTE, $transformer);
    }

    public function getLot(BaseInformation $baseInformation, $lotNumber)
    {
        $lot = [HeaderEnum::LOT_NUMBER => $lotNumber];
        $transformer = new PedidoConsultaLoteNFTS();
        return $this->processRequest($baseInformation, $lot, NftsMethods::CONSULTA_LOTE, $transformer);
    }

    public function checkEmission(BaseInformation $baseInformation, $params)
    {
        if($params instanceof UserRequest)
            $params = $params->toArray();

        $transformer = new PedidoConsultaEmissaoNFSE();
        return $this->processRequest($baseInformation, $params, NftsMethods::CONSULTA_AUT_EMISSAO, $transformer);
    }

    public function testLotNfts(BaseInformation $baseInformation, $params)
    {
        if($params instanceof UserRequest)
            $params = $params->toArray();

        $transformer = new PedidoConsultaEmissaoNFSE();
        return $this->processRequest($baseInformation, $params, NftsMethods::CONSULTA_AUT_EMISSAO, $transformer);
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

        // Send to API
        $output = ApiClient::send($this->endPoint, $method, $information);

        // Return Response with signed Input and Output
        return isset($output->success) ? $output : $outputClass->make($information->getXml(), $output);
    }
}