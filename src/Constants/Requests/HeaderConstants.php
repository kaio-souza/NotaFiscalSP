<?php

namespace NotaFiscalSP\Constants\Requests;

class HeaderConstants
{
    const HEADER = 'Cabecalho';
    const VERSION = 'Versao';
    const CPFCNPJ_SENDER = 'CPFCNPJRemetente';
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
            HeaderConstants::IM,
            SimpleFieldsConstants::IM_PROVIDER,
            HeaderConstants::DEDUCTION_TOTAL,
            HeaderConstants::SERVICES_TOTAL,
            HeaderConstants::START_DATE,
            HeaderConstants::END_DATE,
            HeaderConstants::LOT_NUMBER,
            HeaderConstants::TRANSACTION,
            HeaderConstants::PAGE_NUMBER,
            HeaderConstants::RPS_COUNT,
        ];
    }
}