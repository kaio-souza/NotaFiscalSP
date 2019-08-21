<?php

namespace NotaFiscalSP\Constants\Requests;

class SimpleFieldsConstants
{
    const CPF = 'CPF';
    const CNPJ = 'CNPJ';
    const IM_PROVIDER = 'InscricaoPrestador';
    const RPS_SERIES = 'SerieRPS';
    const RPS_NUMBER = 'NumeroRPS';
    const NFE_NUMBER = 'NumeroNFe';
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
    public static function addressFields()
    {
        return [
            SimpleFieldsConstants::TYPE_ADDRESS,
            SimpleFieldsConstants::ADDRESS,
            SimpleFieldsConstants::ADDRESS_NUMBER,
            SimpleFieldsConstants::ADDRESS_COMPLEMENT,
            SimpleFieldsConstants::NEIGHBORHOOD,
            SimpleFieldsConstants::CITY,
            SimpleFieldsConstants::STATE,
            SimpleFieldsConstants::ZIP_CODE,
        ];
    }
}