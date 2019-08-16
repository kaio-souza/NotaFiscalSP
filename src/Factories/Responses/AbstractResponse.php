<?php

namespace NotaFiscalSP\Factories\Responses;

use NotaFiscalSP\Helpers\General;

abstract class AbstractResponse
{
    public $response;
    public $arrayResponse;

    public function checkSuccess()
    {
        return General::param($this->arrayResponse, 'Cabecalho.Sucesso');
    }
}