<?php

namespace NotaFiscalSP\Factories\Responses;

use NotaFiscalSP\Contracts\OutputClass;
use NotaFiscalSP\Helpers\General;

abstract class AbstractResponse implements OutputClass
{
    public $response;
    public $arrayResponse;

    public function checkSuccess()
    {
        return General::getPath($this->arrayResponse, 'Cabecalho.Sucesso');
    }
}