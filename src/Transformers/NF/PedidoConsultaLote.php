<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Entities\BaseInformation;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoConsultaLote{
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
        ];

        return ArrayToXml::convert($array, [
            'rootElementName' => 'p1:PedidoConsultaLote',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }
}