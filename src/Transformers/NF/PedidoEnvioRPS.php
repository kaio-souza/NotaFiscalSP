<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\RpsData;
use NotaFiscalSP\Helpers\Certificate;
use Spatie\ArrayToXml\ArrayToXml;

class PedidoEnvioRPS{

    public static function makeXmlRequest(BaseInformation $information, RpsData $rps){
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
            'RPS' => [
                'Assinatura' => Certificate::signatureRpsItem($information, $rps),
                'ChaveRPS' => [
                    'InscricaoPrestador' => $information->getIm(),
                    'SerieRPS' => $rps->getSerieRPS(),
                    'NumeroRPS' => $rps->getNumeroRPS(),
                ],
                'TipoRPS' => $rps->getTipoRPS(),
                'DataEmissao' => $rps->getDataEmissao(),
                'StatusRPS' => $rps->getStatusRPS(),
                'TributacaoRPS' => $rps->getTributacaoRPS(),
                'ValorServicos' => $rps->getValorServicos(),
                'ValorDeducoes' =>$rps->getValorDeducoes(),
                'ValorPIS' => $rps->getValorPIS(),
                'ValorCOFINS' => $rps->getValorCOFINS(),
                'ValorINSS' => $rps->getValorINSS(),
                'ValorIR' => $rps->getValorIR(),
                'ValorCSLL' => $rps->getValorCSLL(),
                'CodigoServico' => $rps->getCodigoServico(),
                'AliquotaServicos' => $rps->getAliquotaServicos(),
                'ISSRetido' => $rps->getIssRetido(),
                'CPFCNPJTomador' => [
                    $typeDocument => $rps->getCpfCnpjTomador(),
                ],
                'RazaoSocialTomador' => $rps->getRazaoSocialTomador(),
                'EnderecoTomador' => [
                    'TipoLogradouro' => $rps->getTipoLogradouro(),
                    'Logradouro' => $rps->getLogradouro(),
                    'NumeroEndereco' => $rps->getNumeroEndereco(),
                    'ComplementoEndereco' => $rps->getComplementoEndereco(),
                    'Bairro' => $rps->getBairro(),
                    'Cidade' => $rps->getCidade(),
                    'UF' => $rps->getUf(),
                    'CEP' => $rps->getCep(),
                ],
                'EmailTomador' => $rps->getEmailTomador(),
                'Discriminacao' => $rps->getDiscriminacao(),

            ]
        ];

        return ArrayToXml::convert($array, [
            'rootElementName' => 'PedidoEnvioRPS',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
            ],
        ], true, 'UTF-8');
    }

}