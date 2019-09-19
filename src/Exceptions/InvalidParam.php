<?php

namespace NotaFiscalSP\Exceptions;

class InvalidParam extends \Exception
{
    public function __construct($field = '',$correct = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Invalid value to field'.$field.', expected:'.$correct, $code, $previous);
    }
}