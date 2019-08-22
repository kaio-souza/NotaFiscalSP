<?php

namespace NotaFiscalSP;

use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\Nf;
use NotaFiscalSP\Entities\Requests\Period;
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

    public function emmitNf($params)
    {
        return $this->nfService->emmit($this->baseInformation, $params);
    }

    public function emmitLot(array $params)
    {
        return $this->nfService->emmitLot($this->baseInformation, $params);
    }
}