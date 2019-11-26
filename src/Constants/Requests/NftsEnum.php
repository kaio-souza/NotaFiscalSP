<?php

namespace NotaFiscalSP\Constants\Requests;

class NftsEnum
{
    const NFTS = 'NFTS';
    const DOCUMENT_TYPE = 'TipoDocumento';
    const DOCUMENT_KEY = 'ChaveDocumento';
    const IM = 'InscricaoMunicipal';
    const DELIVERY_DATE = 'DataPrestacao';
    const DOCUMENT_NUMBER = 'NumeroDocumento';
    const STATUS = 'StatusNFTS';
    const NFTS_TAX = 'TributacaoNFTS';
    const SERVICE_VALUE = 'ValorServicos';
    const DEDUCTIONS_VALUE = 'ValorDeducoes';
    const SERVICE_CODE = 'CodigoServico';
    const SUB_ITEM_CODE = 'CodigoSubItem';
    const SERVICE_TAX = 'AliquotaServicos';
    const NFTS_SERIES = 'SerieNFTS';
    const ISS_TAKER = 'ISSRetidoTomador';
    const ISS_INTERMEDIARY = 'ISSRetidoIntermediario';
    const IGNORES_LAW_1572016 = 'DescumpreLeiComplementar1572016';
    const PROVIDER = 'Prestador';
    const CPF_PROVIDER = 'CPF';
    const CNPJ_PROVIDER = 'CNPJ';
    const TAXATION_REGIME = 'RegimeTributacao';
    const DISCRIMINATION = 'Discriminacao';
    const TYPE = 'TipoNFTS';
    const PAYMENT_DATE = 'DataPagamento';
    const TAKER = 'Tomador';
    const CEI_CODE = 'CodigoCEI';
    const WORK_REGISTRATION = 'MatriculaObra';
    const CORPORATE_NAME_PROVIDER = 'RazaoSocialPrestador';
    const EMAIL_PROVIDER = 'Email';

    public static function simpleTypes()
    {
        return [
            NftsEnum::DELIVERY_DATE,
            NftsEnum::STATUS,
            NftsEnum::NFTS_TAX,
            NftsEnum::SERVICE_VALUE,
            NftsEnum::DEDUCTIONS_VALUE,
            NftsEnum::SERVICE_CODE,
            NftsEnum::SUB_ITEM_CODE,
            NftsEnum::SERVICE_TAX,
            NftsEnum::ISS_TAKER,
            NftsEnum::ISS_INTERMEDIARY,
            NftsEnum::IGNORES_LAW_1572016,

        ];
    }

    public static function otherSimpleTypes()
    {
        return [
            NftsEnum::TAXATION_REGIME,
            NftsEnum::PAYMENT_DATE,
            NftsEnum::DISCRIMINATION,
            NftsEnum::TYPE,
            NftsEnum::TAKER,
            NftsEnum::CEI_CODE,
            NftsEnum::WORK_REGISTRATION,
        ];
    }
}