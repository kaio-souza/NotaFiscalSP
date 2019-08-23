<?php

namespace NotaFiscalSP\Constants\Requests;

class HeaderEnum
{
    const HEADER = 'Cabecalho';
    const VERSION = 'Versao';
    const CPFCNPJ_SENDER = 'CPFCNPJRemetente';
    const CPFCNPJ = 'CPFCNPJ';
    /**
     * @int
     */
    const LOT_NUMBER = 'NumeroLote';
    /**
     * @boolean
     */
    const TRANSACTION = 'transacao';
    /**
     * @int
     */
    const IM = 'Inscricao';
    /**
     * @format YYYY-MM-DD
     */
    const START_DATE = 'dtInicio';
    /**
     * @format YYYY-MM-DD
     */
    const END_DATE = 'dtFim';
    /**
     * @int
     */
    const PAGE_NUMBER = 'NumeroPagina';
    /**
     * @int
     */
    const RPS_COUNT = 'QtdRPS';

    /**
     * @money 00.00
     */
    const SERVICES_TOTAL = 'ValorTotalServicos';
    /**
     * @money 00.00
     */
    const DEDUCTION_TOTAL = 'ValorTotalDeducoes';

    public static function simpleTypes()
    {
        return [
            HeaderEnum::IM,
            SimpleFieldsEnum::IM_PROVIDER,
            HeaderEnum::TRANSACTION,
            HeaderEnum::LOT_NUMBER,
            HeaderEnum::START_DATE,
            HeaderEnum::END_DATE,
            HeaderEnum::PAGE_NUMBER,
            HeaderEnum::RPS_COUNT,
            HeaderEnum::SERVICES_TOTAL,
            HeaderEnum::DEDUCTION_TOTAL,
        ];
    }
}