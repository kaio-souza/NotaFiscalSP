<?php
namespace NotaFiscalSP\Transformers\NFS;

use NotaFiscalSP\Entities\BaseInformation;

use NotaFiscalSP\Helpers\Xml;
use Spatie\ArrayToXml\ArrayToXml;

class  CnpjInformation {
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

        return Xml::makeRequest('p1:PedidoConsultaCNPJ', $array);
    }
}