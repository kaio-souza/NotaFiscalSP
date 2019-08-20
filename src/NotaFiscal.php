<?php

namespace NotaFiscalSP;

use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Factories\BaseEntitiesFactory;
use NotaFiscalSP\Helpers\General;
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
    private $nfService;
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

    public function cnpjInformation()
    {
        return $this->nfService->checkCNPJ($this->baseInformation);
    }

    public function checkNf(array $params){
        return $this->nfService->getkNf($this->baseInformation, $params);
    }

    public function lotInformation(array $params = []){
        return $this->nfService->lotInformation($this->baseInformation, $params);
    }
    public function checkLot($lotNumber){
        return $this->nfService->getLot($this->baseInformation, $lotNumber);
    }

    public function nfIssued(array $params){
        return $this->nfService->getIssued($this->baseInformation, $params);
    }
    public function nfReceived(array $params){
        return $this->nfService->getReceived($this->baseInformation, $params);
    }
    public function cancelNf(array $params){
        return $this->nfService->cancelNf($this->baseInformation, $params);
    }
}