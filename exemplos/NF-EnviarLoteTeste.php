<?php

use NotaFiscalSP\Constants\FieldData\RPSType;
use NotaFiscalSP\Entities\Requests\NF\Lot;
use NotaFiscalSP\Entities\Requests\NF\Rps;
use NotaFiscalSP\NotaFiscalSP;
use NotaFiscalSP\Constants\Params;

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

// Monte a RPS
$rps = new Rps();
$rps->setNumeroRps('300000000');
$rps->setTipoRps(RPSType::RECIBO_PROVENIENTE_DE_NOTA_CONJUGADA);
$rps->setValorServicos(30.80);
$rps->setCodigoServico(2881);
$rps->setAliquotaServicos(0.029);
$rps->setCnpj('20000004000100');
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

// Monte o Objeto do Lote
$lot = new Lot();

// Insira os RPS
$lot->setRpsList(
    [
        $rps,
    ]
);

// Envie a Requisição - testeEnviarLote(Teste) ou enviarLote(Produção)
$request = $nf->testeEnviarLote($lot);

// Utilize algum dos métodos do response para verificar o resultado
echo $request->getXmlOutput();
exit;