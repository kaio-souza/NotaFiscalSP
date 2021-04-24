<?php

namespace NotaFiscalSP;

use Dompdf\Dompdf;
use NotaFiscalSP\Builders\BaseEntitiesBuilder;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Services\NfService;
use NotaFiscalSP\Services\NftsService;
use NotaFiscalSP\Validators\BaseInformationValidator;

/**
 * Class NotaFiscalSP
 * @package NotaFiscalSP
 */
class NotaFiscalSP
{
    private $baseInformation;
    private $nfService;
    private $nftsService;

    public function __construct(array $options)
    {
        // Validate Params
        BaseInformationValidator::basic($options);
        $this->baseInformation = BaseEntitiesBuilder::makeBaseInformation($options);

        $this->nfService = new NfService;
        $this->nftsService = new NftsService;

        // Case 'IM' not Defined, get from API
        if (!$this->baseInformation->getIm())
            $this->baseInformation->setIm($this->cnpjInfo());
    }

    /**
     *  NF METHODS
     */

    public function cnpjInfo($document = null)
    {
        return $this->nfService->checkCNPJ($this->baseInformation, $document);
    }

    public function consultarNf($params)
    {
        return $this->nfService->getNf($this->baseInformation, $params);
    }

    public function informacaoLote($params = [])
    {
        return $this->nfService->lotInformation($this->baseInformation, $params);
    }

    public function consultarLote($lotNumber)
    {
        return $this->nfService->getLot($this->baseInformation, $lotNumber);
    }

    public function notasEmitidas($params)
    {
        return $this->nfService->getIssued($this->baseInformation, $params);
    }

    public function notasRecebidas($params)
    {
        return $this->nfService->getReceived($this->baseInformation, $params);
    }

    public function cancelarNota($params)
    {
        return $this->nfService->cancelNf($this->baseInformation, $params);
    }

    public function enviarNota($params)
    {
        return $this->nfService->sendNf($this->baseInformation, $params);
    }

    public function enviarLote($params)
    {
        return $this->nfService->sendLot($this->baseInformation, $params);
    }

    public function testeEnviarLote($params)
    {
        return $this->nfService->testSendLot($this->baseInformation, $params);
    }

    public function arquivoNota($nfNumber, $imProvider = null, $verificationCode = null)
    {
        if (!$imProvider || !$verificationCode) {
            $nf = $this->consultarNf($nfNumber);
            $imProvider = $nf->response['NFe']['ChaveNFe']['InscricaoPrestador'];
            $verificationCode = $nf->response['NFe']['ChaveNFe']['CodigoVerificacao'];
        }
        $uri = General::getPreviewLink($imProvider, $nfNumber, $verificationCode);

        $body = "<html><body><img style=\"max-width: 100%\" src=\"{$uri}\" /></body></html>";

        $dompdf = new Dompdf(array('enable_remote' => true));
        $dompdf->loadHtml($body);
        $dompdf->setPaper('A4', "portrail");
        $dompdf->render();
        return $dompdf->output();
    }

    /**
     *  ASYNC NF METHODS
     */

    public function testeEnviarLoteAsync($params)
    {
        return $this->nfService->testSendAsyncLot($this->baseInformation, $params);
    }

    public function enviarLoteAsync($params)
    {
        return $this->nfService->sendAsyncLot($this->baseInformation, $params);
    }

    public function emitirGuiaAsync($params)
    {
        return $this->nfService->makeReceiptAsync($this->baseInformation, $params);
    }

    public function consultarSituacaoGuia($params)
    {
        return $this->nfService->checkReceiptSituation($this->baseInformation, $params);
    }

    public function consultarGuia($params)
    {
        return $this->nfService->checkReceipt($this->baseInformation, $params);
    }

    public function consultarLoteAsync($params)
    {
        return $this->nfService->checkAsyncLot($this->baseInformation, $params);
    }

    /**
     *  NFTS
     */
    public function consultarNfts($params)
    {
        return $this->nftsService->getNfts($this->baseInformation, $params);
    }

    public function informacaLoteNfts($params = [])
    {
        return $this->nftsService->lotInformation($this->baseInformation, $params);
    }

    public function consultarLoteNfts($lotNumber)
    {
        return $this->nftsService->getLot($this->baseInformation, $lotNumber);
    }

    public function consultarAutorizacaoEmissao($params = null)
    {
        return $this->nftsService->checkEmission($this->baseInformation, $params);
    }

    public function testeLoteNfts($params)
    {
        return $this->nftsService->testLotNFTS($this->baseInformation, $params);
    }

    public function enviarLoteNfts($params)
    {
        return $this->nftsService->lotNfts($this->baseInformation, $params);
    }

    public function enviarNfts($params)
    {
        return $this->nftsService->sendNfts($this->baseInformation, $params);
    }

    public function cancelarNfts($params)
    {
        return $this->nftsService->cancelNfts($this->baseInformation, $params);
    }

}