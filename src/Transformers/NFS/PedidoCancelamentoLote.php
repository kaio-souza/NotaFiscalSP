<?php
namespace NotaFiscalSP\Transformers\NFS;

use NotaFiscalSP\Entities\BaseInformation;
use Spatie\ArrayToXml\ArrayToXml;

class PedidoCancelamentoLote
{
    public static function makeXmlRequest(BaseInformation $information, $lotNumber){
        $array = [
            'Cabecalho' => [
                '_attributes' => [
                    'Versao' => 1
                ],
                'CPFCNPJRemetente' => [
                    'CNPJ' => $information->getCnpj()
                ],
                'NumeroLote' => $lotNumber
            ],
            'Detalhe' => [
                'ChaveNFe' => [
                    'InscricaoPrestador' => $information->getIm(),
                    'NumeroNFe' => $lotNumber
                ],
                'AssinaturaCancelamento' => ''
            ]
        ];

        return ArrayToXml::convert($array, [
            'rootElementName' => 'PedidoCancelamentoLote',
            '_attributes' => [
                'xmlns' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }
}
