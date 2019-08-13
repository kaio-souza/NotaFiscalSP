<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\RpsData;
use NotaFiscalSP\Helpers\Certificate;
use Spatie\ArrayToXml\ArrayToXml;

class PedidoConsultaNFe{

    public static function makeXmlRequest(BaseInformation $information, RpsData $rps)
    {
        $typeDocument = $rps->getCpfTomador() ? 'CPF' : 'CNPJ';
        $array = [
            'Cabecalho' => [
                '_attributes' => [
                    'Versao' => 1
                ],
                'CPFCNPJRemetente' => [
                    'CNPJ' => $information->getCnpj()
                ],
            ],
            'Detalhe' => [
                'Assinatura' => Certificate::signatureRpsItem($information, $rps),
                'ChaveRPS' => [
                    'InscricaoPrestador' => $information->getIm(),
                    'SerieRPS' => $rps->getSerieRPS(),
                    'NumeroRPS' => $rps->getNumeroRPS(),
                ],
                'ChaveNFe' => [
                    'InscricaoPrestador' => $information->getIm(),
                    'NumeroNFe' => $rps->getSerieRPS(),
                    'CodigoVerificacao' => $rps->getNumeroRPS(),
                ]
            ]
        ];

        return ArrayToXml::convert($array, [
            'rootElementName' => 'PedidoConsultaNFe',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
            ],
        ], true, 'UTF-8');
    }

}