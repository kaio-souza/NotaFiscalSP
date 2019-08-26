<?php

namespace NotaFiscalSP\Constants\Requests;

class  DetailEnum
{
    const DETAIL = 'Detalhe';
    const DETAIL_NFTS = 'DetalheNFTS';
    const DETAIL_EMISSION = 'DetalheEmissNFSE';
    const DETAIL_LOT_INFORMATION = 'DetalheInformacoesLote';
    const DETAIL_LOT = 'DetalheLoteNFTS';
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