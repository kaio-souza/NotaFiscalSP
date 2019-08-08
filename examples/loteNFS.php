<?php
require '../vendor/autoload.php';
use NotaFiscalSP\NotaFiscal;
use NotaFiscalSP\Constants\Params;

$nf = new NotaFiscal([
    Params::CNPJ => 'xxxx',
    Params::IM => 'xxxx',
    Params::CERTIFICATE_PATH => 'path/to/digita/certificate.pfx',
    Params::CERTIFICATE_PASS => '0123456'
]);