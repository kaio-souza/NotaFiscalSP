<?php

namespace NotaFiscalSP\Constants\Requests;

class  DetailConstants
{
    const DETAIL = 'Detalhe';
    const CANCELLATION_SIGN = 'AssinaturaCancelamento';
    const SIGN = 'Assinatura';

    public static function signedTypes()
    {
        return [
            DetailConstants::SIGN,
            DetailConstants::CANCELLATION_SIGN
        ];
    }
}