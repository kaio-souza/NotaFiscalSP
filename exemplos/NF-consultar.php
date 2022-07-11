<?php

require('vendor/autoload.php');

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Entities\Requests\NF\Period;
use NotaFiscalSP\NotaFiscalSP;

/* *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
 *  Para esse Exemplo funcionar é necessário um certificado válido (*.pfx ou *.pem)                *
 *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  * */

// Instancie a Classe
$nf = new NotaFiscalSP([
    Params::CNPJ => '00027000000000',
    Params::IM => '00000002', // Opcional porém recomendado
    Params::CERTIFICATE_PATH => 'examples/certificate.pfx',
    Params::CERTIFICATE_PASS => '100001'
]);

$period = new Period();

$period->setDtInicio('2022-07-05')
    ->setDtFim('2022-07-10')
    ->setPagina(2)
    ->setInscricaoMunicipal(00000000);

$emitidas = $nf->notasEmitidas($period);
print_r($emitidas->getResponse());
exit;