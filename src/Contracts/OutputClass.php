<?php

namespace NotaFiscalSP\Contracts;

use NotaFiscalSP\Entities\BaseInformation;

interface OutputClass
{
    public function make($input, $output);
}