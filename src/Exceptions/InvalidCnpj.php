<?php

namespace NotaFiscalSP\Exceptions;

class InvalidCnpj extends \Exception
{
    public function __construct($field = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('CNPJ not enabled to this function', $code, $previous);
    }
}