<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Certificate;
use Spatie\ArrayToXml\ArrayToXml;

class PedidoCancelamentoNFe
{
    public static function makeXmlRequest(BaseInformation $information, $nfe){
        $cancelKey = PedidoCancelamentoNFe::getContentString($information, $nfe);
        $array = [
            'Cabecalho' => [
                '_attributes' => [
                    'Versao' => 1
                ],
                'CPFCNPJRemetente' => [
                    'CNPJ' => $information->getCnpj()
                ],
                'transacao' => true
            ],
            'Detalhe' => [
                'ChaveNFe' => [
                    'InscricaoPrestador' => $information->getIm(),
                    'NumeroNFe' => $nfe
                ],
                'AssinaturaCancelamento' => Certificate::signatureRpsItem($information, $cancelKey)
            ]
        ];

        return ArrayToXml::convert($array, [
            'rootElementName' => 'PedidoCancelamentoNFe',
            '_attributes' => [
                'xmlns' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }




}
