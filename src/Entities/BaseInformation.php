<?php
namespace NotaFiscalSP\Entities;

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Helpers\Certificate;

/**
 * Class BaseInformation
 * @package NotaFiscalSP\Entities
 */
class BaseInformation{
    /**
     * @var
     *  Todos Processos exigem o CNPJ como uma identificação
     */
    private $cnpj;
    /**
     * @var
     *  Inscrição Municipal da Empresa é informada na Nota Fiscal Obrigatóriamente
     */
    private $im;

    /**
     * @var
     *  Para Realizar o acesso a API e Assinar é obrigatório o Certifiado digital da empresa
     */
    private $certificate;


    /**
     * @var
     */
    private $certificatePass;

    /**
     * @return mixed
     */
    public function getCertificatePass()
    {
        return $this->certificatePass;
    }

    /**
     * @param mixed $certificatePass
     */
    public function setCertificatePass($certificatePass)
    {
        $this->certificatePass = $certificatePass;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return mixed
     */
    public function getIm()
    {
        return $this->im;
    }

    /**
     * @param mixed $im
     */
    public function setIm($im)
    {
        $this->im = $im;
    }

    /**
     * @return mixed
     */
    public function getCertificate()
    {
        return $this->certificate;
    }


    /**
     * @param $options
     * @return false|string
     * @throws \Exception
     */
    public function setCertificate($options)
    {
        if(strpos($options[Params::CERTIFICATE_PATH],'.pfx'))
        {
            $certificate = Certificate::pfx2pem($options[Params::CERTIFICATE_PATH], $options[Params::CERTIFICATE_PASS]);
        } else {
            $certificate = file_get_contents($options[Params::CERTIFICATE_PATH]);
        }
        return $this->certificate = $certificate;
    }




}