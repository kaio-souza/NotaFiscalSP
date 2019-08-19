<?php

namespace NotaFiscalSP\Contracts;

use NotaFiscalSP\Entities\BaseInformation;

interface InputTransformer
{
    public function makeXmlRequest(BaseInformation $information, $params);
}