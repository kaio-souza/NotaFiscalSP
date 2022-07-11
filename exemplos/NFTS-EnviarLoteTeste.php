<?php

/* *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
 *  Para esse Exemplo funcionar é necessário um certificado válido (*.pfx ou *.pem)                *
 *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  * */

// Instancie a Classe
use NotaFiscalSP\Constants\FieldData\DocumentType;
use NotaFiscalSP\Entities\Requests\NFTS\Nfts;
use NotaFiscalSP\Entities\Requests\NFTS\NftsLot;
use NotaFiscalSP\NotaFiscalSP;
use NotaFiscalSP\Constants\Params;

$nf = new NotaFiscalSP([
    Params::CNPJ => '00027000000000',
    Params::IM => '00000002', // Opcional porém recomendado
    Params::CERTIFICATE_PATH => 'examples/certificate.pfx',
    Params::CERTIFICATE_PASS => '100001'
]);

// Monte a NFTS
$nfts = new Nfts();
$nfts->setNumeroDocumento('000000000163'); // Numero da nota Relacionada a NFTS
$nfts->setSerieNFTS('A'); // Serie da Nota relacionada
$nfts->setCodigoServico('7099');
$nfts->setValorServicos('165.31');
$nfts->setCnpjPrestador('00000040000100');
$nfts->setDiscriminacao('NFTS X ...');
$nfts->setDataPrestacao('2019-09-10');
$nfts->setTipoDocumento(DocumentType::WITHOUT_REQUIRED_EMISSION_FISCAL_DOCUMENT);
$nfts->setRazaoSocialPrestador('Razao Social Teste');
$nfts->setLogradouroPrestador('Avenida x x x');
$nfts->setCidadePrestador('Cidade X');
$nfts->setNumeroEnderecoPrestador('250');
$nfts->setBairroPrestador('Vila x');
$nfts->setUfPrestador('SP');
$nfts->setCepPrestador('06000000');

// Crie o Lote
$lot = new NftsLot();
$lot->setNftsList(
    [
        $nfts,
    ]
);

// Envie a Request testeLoteNfts(Teste) ou enviarLoteNfts(Produção)
$request = $nf->testeLoteNfts($lot);

// Utilize algum dos métodos do response para verificar o resultado
echo $request->getXmlOutput();
exit;