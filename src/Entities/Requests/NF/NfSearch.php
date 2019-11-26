<?php

namespace NotaFiscalSP\Entities\Requests\NF;

use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Helpers\General;

/**
 * Class NfSearch
 * @package NotaFiscalSP\Entities\Requests
 */
class NfSearch implements UserRequest
{
    /**
     * @var
     */
    private $inscricaoPrestador;
    /**
     * @var
     */
    private $numeroNfe;
    /**
     * @var
     */
    private $codigoVerificacao;
    /**
     * @var
     */
    private $numeroRPS;
    /**
     * @var
     */
    private $serieRPS;

    /**
     * @return mixed
     */
    public function getInscricaoPrestador()
    {
        return $this->inscricaoPrestador;
    }

    /**
     * @param mixed $inscricaoPrestador
     */
    public function setInscricaoPrestador($inscricaoPrestador)
    {
        $this->inscricaoPrestador = sprintf('%08s', General::onlyNumbers($inscricaoPrestador));
    }

    /**
     * @return mixed
     */
    public function getNumeroNfe()
    {
        return $this->numeroNfe;
    }

    /**
     * @param mixed $numeroNfe
     */
    public function setNumeroNfe($numeroNfe)
    {
        $this->numeroNfe = $numeroNfe;
    }

    /**
     * @return mixed
     */
    public function getCodigoVerificacao()
    {
        return $this->codigoVerificacao;
    }

    /**
     * @param mixed $codigoVerificacao
     */
    public function setCodigoVerificacao($codigoVerificacao)
    {
        $this->codigoVerificacao = $codigoVerificacao;
    }

    /**
     * @return mixed
     */
    public function getNumeroRPS()
    {
        return $this->numeroRPS;
    }

    /**
     * @param mixed $numeroRPS
     */
    public function setNumeroRPS($numeroRPS)
    {
        $this->numeroRPS = $numeroRPS;
    }

    /**
     * @return mixed
     */
    public function getSerieRPS()
    {
        return $this->serieRPS;
    }

    /**
     * @param mixed $serieRPS
     */
    public function setSerieRPS($serieRPS)
    {
        $this->serieRPS = $serieRPS;
    }

    public function toArray()
    {
        return [
            SimpleFieldsEnum::IM_PROVIDER => $this->inscricaoPrestador,
            SimpleFieldsEnum::NFE_NUMBER => $this->numeroNfe,
            SimpleFieldsEnum::VERIFICATION_CODE => $this->codigoVerificacao,
            SimpleFieldsEnum::RPS_NUMBER => $this->numeroRPS,
            SimpleFieldsEnum::RPS_SERIES => $this->serieRPS,
        ];
    }


}