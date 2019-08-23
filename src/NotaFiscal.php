<?php

namespace NotaFiscalSP;

use NotaFiscalSP\Factories\BaseEntitiesFactory;
use NotaFiscalSP\Services\NfService;
use NotaFiscalSP\Services\NftsService;
use NotaFiscalSP\Validators\BaseInformationValidator;

/**
 * Class NotaFiscal
 * @package NotaFiscalSP
 */
class NotaFiscal
{
    private $baseInformation;
    private $nfService;
    private $nftsService;

    public function __construct(array $options)
    {
        // Validate Params
        BaseInformationValidator::basic($options);
        $this->baseInformation = BaseEntitiesFactory::makeBaseInformation($options);

        $this->nfService = new NfService;
        $this->nftsService = new NftsService;

        // Case 'IM' not Defined, get from API
        if (!$this->baseInformation->getIm())
            $this->baseInformation->setIm($this->cnpjInformation());
    }

    /**
     *  NF METHODS
     */

    public function cnpjInformation()
    {
        return $this->nfService->checkCNPJ($this->baseInformation);
    }

    public function checkNf($params)
    {
        return $this->nfService->getNf($this->baseInformation, $params);
    }

    public function lotInformation($params = [])
    {
        return $this->nfService->lotInformation($this->baseInformation, $params);
    }

    public function checkLot($lotNumber)
    {
        return $this->nfService->getLot($this->baseInformation, $lotNumber);
    }

    public function nfIssued($params)
    {
        return $this->nfService->getIssued($this->baseInformation, $params);
    }

    public function nfReceived($params)
    {
        return $this->nfService->getReceived($this->baseInformation, $params);
    }

    public function cancelNf($params)
    {
        return $this->nfService->cancelNf($this->baseInformation, $params);
    }

    public function sendNf($params)
    {
        return $this->nfService->sendNf($this->baseInformation, $params);
    }

    public function sendLot($params)
    {
        return $this->nfService->sendLot($this->baseInformation, $params);
    }

    public function testSendLot($params)
    {
        return $this->nfService->testSendLot($this->baseInformation, $params);
    }

    /**
     *  ASYNC NF METHODS
     */

    public function testSendAsyncLot($params)
    {
        return $this->nfService->testSendAsyncLot($this->baseInformation, $params);
    }

    public function sendAsyncLot($params)
    {
        return $this->nfService->sendAsyncLot($this->baseInformation, $params);
    }

    public function makeReceiptAsync($params)
    {
        return $this->nfService->makeReceiptAsync($this->baseInformation, $params);
    }

    public function checkReceiptSituation($params)
    {
        return $this->nfService->checkReceiptSituation($this->baseInformation, $params);
    }

    public function checkReceipt($params)
    {
        return $this->nfService->checkReceipt($this->baseInformation, $params);
    }

    public function checkAsyncLot($params)
    {
        return $this->nfService->checkAsyncLot($this->baseInformation, $params);
    }

    /**
     *  NFTS
     */
    public function checkNfts($params)
    {
        return $this->nftsService->checkAsyncLot($this->baseInformation, $params);
    }


}