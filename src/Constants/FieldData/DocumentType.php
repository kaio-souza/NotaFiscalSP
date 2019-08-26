<?php

namespace NotaFiscalSP\Constants\FieldData;

class DocumentType
{
//    Dispensado de emissão de documento fiscal.
    const WITHOUT_REQUIRED_EMISSION_FISCAL_DOCUMENT = '01';

//    Com emissão de documento fiscal autorizado pelo município.
    const REQUIRED_EMISSION_FISCAL_DOCUMENT = '02';

//    Sem emissão de documento fiscal embora obrigado.
    const WITHOUT_EMISSION_BUT_REQUIRED_FISCAL_DOCUMENT = '03';
}