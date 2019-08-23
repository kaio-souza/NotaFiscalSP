<?php

namespace NotaFiscalSP\Constants\Requests;

class  DetailEnum
{
    const DETAIL = 'Detalhe';
    const CANCELLATION_SIGN = 'AssinaturaCancelamento';
    const SIGN = 'Assinatura';
    const IM = 'InscricaoMunicipal';

    public static function signedTypes()
    {
        return [
            DetailEnum::SIGN,
            DetailEnum::CANCELLATION_SIGN
        ];
    }
}