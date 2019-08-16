<?php

namespace NotaFiscalSP;

use NotaFiscalSP\Entities\BaseInformation;
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
        $xml = $this->nfService->checkCNPJ($this->baseInformation);
        return $xml;
    }

}