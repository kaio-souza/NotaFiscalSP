<?php

namespace NotaFiscalSP;

use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\Rps;
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
    /**
     * @var BaseInformation
     */
    private $baseInformation;
    /**
     * @var NfService
     */
    private $nfService;
    /**
     * @var NftsService
     */
    private $nftsService;

    /**
     * NotaFiscal constructor.
     * @param array $options
     * @throws Exceptions\RequiredDataMissing
     */
    public function __construct(array $options)
    {
        // Validate Params
        BaseInformationValidator::basic($options);
        $this->baseInformation = BaseEntitiesFactory::makeBaseInformation($options);

        $this->nfService = new NfService;
        $this->nftsService = new NftsService;

        if (!$this->baseInformation->getIm())
            $this->baseInformation->setIm($this->cnpjInformation());
    }

    /**
     * @return Responses\BasicResponse
     */
    public function cnpjInformation()
    {
        return $this->nfService->checkCNPJ($this->baseInformation);
    }

    /**
     * @param array $params
     * @return Responses\BasicResponse
     */
    public function checkNf(array $params)
    {
        return $this->nfService->getNf($this->baseInformation, $params);
    }

    /**
     * @param array $params
     * @return Responses\BasicResponse
     */
    public function lotInformation(array $params = [])
    {
        return $this->nfService->lotInformation($this->baseInformation, $params);
    }

    /**
     * @param $lotNumber
     * @return Responses\BasicResponse
     */
    public function checkLot($lotNumber)
    {
        return $this->nfService->getLot($this->baseInformation, $lotNumber);
    }

    /**
     * @param array $params
     * @return Responses\BasicResponse
     */
    public function nfIssued(array $params)
    {
        return $this->nfService->getIssued($this->baseInformation, $params);
    }

    /**
     * @param array $params
     * @return Responses\BasicResponse
     */
    public function nfReceived(array $params)
    {
        return $this->nfService->getReceived($this->baseInformation, $params);
    }

    /**
     * @param array $params
     * @return Responses\BasicResponse
     */
    public function cancelNf(array $params)
    {
        return $this->nfService->cancelNf($this->baseInformation, $params);
    }

    /**
     * @param array $params
     * @return Responses\BasicResponse
     */
    public function emmitNf(Rps $params)
    {
        return $this->nfService->emmit($this->baseInformation, $params);
    }

    public function emmitLot(array $params)
    {
        return $this->nfService->emmitLot($this->baseInformation, $params);
    }
}