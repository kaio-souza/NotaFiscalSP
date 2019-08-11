<?php
namespace NotaFiscalSP\Transformers;

use NotaFiscalSP\Entities\BaseInformation;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoConsultaCNPJ{
    public static function makeXmlRequest(BaseInformation $information){
        $array = [
            'Cabecalho' => [
                '_attributes' => [
                    'Versao' => 1
                ],
                'CPFCNPJRemetente' => [
                    'CNPJ' => $information->getCnpj()
                ]
            ],
            'CNPJContribuinte' =>[
                'CNPJ' => $information->getCnpj()
            ]
        ];

        return ArrayToXml::convert($array, [
            'rootElementName' => 'p1:PedidoConsultaCNPJ',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }
}