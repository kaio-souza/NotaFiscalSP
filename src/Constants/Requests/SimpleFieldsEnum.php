<?php

namespace NotaFiscalSP\Constants\Requests;

class SimpleFieldsEnum
{
    const CPF = 'CPF';
    const CNPJ = 'CNPJ';
    const CPF_TAKER = 'CPFTomador';
    const CNPJ_TAKER = 'CNPJTomador';
    const CORPORATE_NAME_TAKER = 'RazaoSocialTomador';
    const CPF_INTERMEDIARY = 'CPFIntermediario';
    const CNPJ_INTERMEDIARY = 'CNPJIntermediario';
    const IM_PROVIDER = 'InscricaoPrestador';
    const RPS_SERIES = 'SerieRPS';
    const RPS_NUMBER = 'NumeroRPS';
    const NFE_NUMBER = 'NumeroNFe';
    const NFTS_NUMBER = 'NumeroNFTS';
    const VERIFICATION_CODE = 'CodigoVerificacao';
    const TYPE_ADDRESS = 'TipoLogradouro';
    const ADDRESS = 'Logradouro';
    const ADDRESS_NUMBER = 'NumeroEndereco';
    const ADDRESS_COMPLEMENT = 'ComplementoEndereco';
    const NEIGHBORHOOD = 'Bairro';
    const CITY = 'Cidade';
    const STATE = 'UF';
    const ZIP_CODE = 'CEP';
    const INCIDENCE = 'Incidencia';
    const SITUATION = 'Situacao';
    const PROTOCOL_NUMBER = 'NumeroProtocolo';
    const EMISSION_TYPE = 'TipoEmissaoGuia';
    const PAYMENT_DATE = 'DataPagamento';
    const LOT_NUMBER = 'NumeroLote';

    public static function addressFields()
    {
        return [
            SimpleFieldsEnum::TYPE_ADDRESS,
            SimpleFieldsEnum::ADDRESS,
            SimpleFieldsEnum::ADDRESS_NUMBER,
            SimpleFieldsEnum::ADDRESS_COMPLEMENT,
            SimpleFieldsEnum::NEIGHBORHOOD,
            SimpleFieldsEnum::CITY,
            SimpleFieldsEnum::STATE,
            SimpleFieldsEnum::ZIP_CODE,
        ];
    }
}