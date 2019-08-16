<?php

namespace NotaFiscalSP\Constants\Requests;

class RpsConstants{
    const RPS = 'RPS';
    const RPS_TYPE = 'TipoRPS';
    const EMISSION_DATE = 'DataEmissao';
    const RPS_STATUS = 'StatusRPS';
    const RPS_TAX= 'TributacaoRPS';
    const SERVICE_VALUE = 'ValorServicos';
    const DEDUCTION_VALUE= 'ValorDeducoes';
    const PIS_VALUE = 'ValorPIS';
    const COFINS_VALUE = 'ValorCOFINS';
    const INSS_VALUE = 'ValorINSS';
    const IR_VALUE = 'ValorIR';
    const CSLL_VALUE = 'ValorCSLL';
    const SERVICE_CODE = 'CodigoServico';
    const SERVICE_TAX= 'AliquotaServicos';
    const ISS_RETENTION= 'ISSRetido';
    const IM_TAKER = 'InscricaoMunicipalTomador';
    const IE_TAKER = 'InscricaoEstadualTomador';
    const CORPORATE_NAME_TAKER = 'RazaoSocialTomador';
    const EMAIL_TAKER = 'EmailTomador';
    const DISCRIMINATION = 'Discriminacao';
    const CPFCNPJ_TAKER= 'CPFCNPJTomador';

    public static function simpleTypes(){
        return [
            RpsConstants::RPS_TYPE,
            RpsConstants::EMISSION_DATE,
            RpsConstants::RPS_STATUS,
            RpsConstants::RPS_TAX,
            RpsConstants::SERVICE_VALUE,
            RpsConstants::DEDUCTION_VALUE,
            RpsConstants::PIS_VALUE,
            RpsConstants::COFINS_VALUE,
            RpsConstants::INSS_VALUE,
            RpsConstants::IR_VALUE,
            RpsConstants::CSLL_VALUE,
            RpsConstants::SERVICE_CODE,
            RpsConstants::SERVICE_TAX,
            RpsConstants::ISS_RETENTION,
            RpsConstants::IM_TAKER,
            RpsConstants::IE_TAKER,
            RpsConstants::CORPORATE_NAME_TAKER,
            RpsConstants::EMAIL_TAKER,
            RpsConstants::DISCRIMINATION,
        ];
    }
}