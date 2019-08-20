<?php
header("Content-type: text/xml");
require '../vendor/autoload.php';

use NotaFiscalSP\Constants\Requests\HeaderConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\NotaFiscal;
use NotaFiscalSP\Constants\Params;

/* *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
 *  Para esse Exemplo funcionar é necessário um certificado válido (*.pfx ou *.pem)                *
 *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  * */
$nf = new NotaFiscal([
    Params::CNPJ => '00000000000000',
    Params::IM => 'xxxx',
    Params::CERTIFICATE_PATH => 'certificate.pfx',
    Params::CERTIFICATE_PASS => '000000'
]);

echo  $nf->nfReceived([
    HeaderConstants::START_DATE => '2019-08-05',
    HeaderConstants::END_DATE => '2019-08-10',
    HeaderConstants::PAGE_NUMBER => 1
])->getXmlOutput();