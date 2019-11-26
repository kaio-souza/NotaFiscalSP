<?php

namespace NotaFiscalSP\Entities\Requests\NFTS;

use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;

class NftsSearch implements UserRequest
{

    public $transacao;
    public $inscricaoMunicipal;
    public $numeroNFTS;

    /**
     * @return mixed
     */
    public function getTransacao()
    {
        return $this->transacao;
    }

    /**
     * @param mixed $transacao
     */
    public function setTransacao($transacao)
    {
        $this->transacao = $transacao;
    }

    /**
     * @return mixed
     */
    public function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
    }

    /**
     * @param mixed $inscricaoMunicipal
     */
    public function setInscricaoMunicipal($inscricaoMunicipal)
    {
        $this->inscricaoMunicipal = $inscricaoMunicipal;
    }

    /**
     * @return mixed
     */
    public function getNumeroNFTS()
    {
        return $this->numeroNFTS;
    }

    /**
     * @param mixed $numeroNFTS
     */
    public function setNumeroNFTS($numeroNFTS)
    {
        $this->numeroNFTS = $numeroNFTS;
    }

    public function toArray()
    {
        return [
            HeaderEnum::TRANSACTION => $this->transacao,
            DetailEnum::IM => $this->inscricaoMunicipal,
            SimpleFieldsEnum::NFTS_NUMBER => $this->numeroNFTS
        ];
    }
}