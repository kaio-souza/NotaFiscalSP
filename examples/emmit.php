<?php
header("Content-type: text/xml");
require '../vendor/autoload.php';

use NotaFiscalSP\Constants\FieldData\RPSType;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Entities\Requests\Rps;
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

$rps = new Rps();
$rps->setNumeroRps('00000000');
$rps->setTipoRps(RPSType::RECIBO_PROVENIENTE_DE_NOTA_CONJUGADA);
$rps->setValorServicos(30.80);
$rps->setCodigoServico(2881);
$rps->setAliquotaServicos( 0.029);
$rps->setCnpj('10000000000001');
$rps->setRazaoSocialTomador('RAZAO SOCIAL TOMADOR LTDA');
$rps->setTipoLogradouro('R');
$rps->setLogradouro('NOME DA RUA');
$rps->setNumeroEndereco(001);
$rps->setBairro('VILA TESTE');
$rps->setCidade('3550308'); // São Paulo
$rps->setUf('SP');
$rps->setCep('00000000');
$rps->setEmailTomador('teste@teste.com.br');
$rps->setDiscriminacao('Teste Emissão de Notas pela API');

echo  $nf->emmitNf($rps)->getXmlOutput();