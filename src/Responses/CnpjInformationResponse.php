<?php

namespace NotaFiscalSP\Responses;

class CnpjInformationResponse extends BaseResponse
{
    // Status CNPJ (Enabled to sendNf NFe?)
    public $status;
    // Inscrição Municipal
    public $im;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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

}