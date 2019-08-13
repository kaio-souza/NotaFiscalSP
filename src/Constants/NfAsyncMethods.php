<?php
namespace NotaFiscalSP\Constants;

class NfAsyncMethods{
    const CONSULTA_GUIA= 'ConsultaGuia';
    const CONSULTA_SITUACAO_GUIA = 'ConsultaSituacaoGuia';
    const CONSULTA_SITUACAO_LOTE  = 'ConsultaSituacaoLote';

    // MessageName="EmissaoGuia"
    const EMISSAO_GUIA_ASYNC = 'EmissaoGuiaAsync';

    // MessageName="EnvioLoteRPS"
    const ENVIO_LOTE = 'EnvioLoteRpsAsync';

    // MessageName="TesteEnvioLoteRPS"
    const TESTE_ENVIO_LOTE = 'TesteEnvioLoteRpsAsync';
}