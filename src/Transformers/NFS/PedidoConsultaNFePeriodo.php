<?php
namespace NotaFiscalSP\Transformers\NFS;

use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\PeriodQueryInformation;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoConsultaNFePeriodo{
    public static function makeXmlRequest(BaseInformation $information,PeriodQueryInformation $periodQueryInformation){
        $array = [
            'Cabecalho' => [
                '_attributes' => [
                    'Versao' => 1
                ],
                'CPFCNPJRemetente' => [
                    'CNPJ' => $information->getCnpj()
                ],
                'CPFCNPJ' => [
                    'CNPJ' => !empty($periodQueryInformation->getCnpj()) ? $periodQueryInformation->getCnpj() : $information->getCnpj()
                ],
                'Inscricao' => $information->getIm(),
                'dtInicio' => $periodQueryInformation->getStartDate(),
                'dtFim' => $periodQueryInformation->getEndDate(),
                'NumeroPagina' => $periodQueryInformation->getPage()
            ],

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