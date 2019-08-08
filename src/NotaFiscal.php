<?php

namespace NotaFiscalSP;

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Entities\BaseInformation;
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
    private $xml;

    /**
     * NotaFiscal constructor.
     * @param array $options
     * @throws Exceptions\RequiredDataMissing
     */
    public function __construct(array $options)
    {
        $this->baseInformation = new BaseInformation();
        // Validate Params
        BaseInformationValidator::basic($options);

        // Set Base Informations
        $this->baseInformation->setCnpj($options[Params::CNPJ]);
        $this->baseInformation->setIm($options[Params::IM]);
        $this->baseInformation->setCertificate($options);
        $this->baseInformation->setCertificatePass($options[Params::CERTIFICATE_PASS]);


    }

}