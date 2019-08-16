<?php

namespace NotaFiscalSP\Entities;

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Responses\CnpjInformationResponse;

/**
 * Class BaseInformation
 * @package NotaFiscalSP\Entities
 */
class BaseInformation
{
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
    private $xmlPath;

    /**
     * @var
     */
    private $xml;
    /**
     * @var
     */
    private $certificatePass;
    /**
     * @var
     */
    private $certificatePath;

    /**
     * @return mixed
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * @param mixed $xml
     */
    public function setXml($file)
    {
        $signed = Certificate::signXmlWithCertificate($this->getCertificate(), $file);

        $tempNam = tempnam('/tmp', 'xml');
        $filename = $tempNam . '.xml';
        $fp = fopen($filename, 'w');
        fwrite($fp, $signed);

        $this->setXmlPath($filename);

        $this->xml = $signed;
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
        if (strpos($options[Params::CERTIFICATE_PATH], '.pfx')) {
            $certificate = Certificate::pfx2pem($options[Params::CERTIFICATE_PATH], $options[Params::CERTIFICATE_PASS]);
            $tempNam = tempnam('/tmp', 'cert');
            $filename = $tempNam . '.pem';
            $fp = fopen($filename, 'w');
            fwrite($fp, $certificate);
            $this->setCertificatePath($filename);
        } else {
            $this->setCertificatePath($options[Params::CERTIFICATE_PATH]);
            $certificate = file_get_contents($options[Params::CERTIFICATE_PATH]);
        }

        return $this->certificate = $certificate;
    }

    /**
     * @return mixed
     */
    public function getXmlPath()
    {
        return $this->xmlPath;
    }

    /**
     * @param mixed $xmlPath
     */
    public function setXmlPath($xmlPath)
    {
        $this->xmlPath = $xmlPath;
    }

    /**
     * @return mixed
     */
    public function getCertificatePath()
    {
        return $this->certificatePath;
    }

    /**
     * @param mixed $certificatePath
     */
    public function setCertificatePath($certificatePath)
    {
        $this->certificatePath = $certificatePath;
    }

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
        if ($im instanceof CnpjInformationResponse) {
            $this->im = $im->getIm();
        } else {
            $this->im = $im;
        }
    }
}