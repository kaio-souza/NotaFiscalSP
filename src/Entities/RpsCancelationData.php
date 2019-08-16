<?php

namespace NotaFiscalSP\Entities;

class RpsCancelationData
{
    private $inscricaoPrestador;
    private $numeroNFe;

    public function getContentString()
    {
        return sprintf('%08s', $this->getInscricaoPrestador()) .
            sprintf('%012s', $this->getNumeroNFe());
    }

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
        $this->inscricaoPrestador = $inscricaoPrestador;
    }

    /**
     * @return mixed
     */
    public function getNumeroNFe()
    {
        return $this->numeroNFe;
    }

    /**
     * @param mixed $numeroNFe
     */
    public function setNumeroNFe($numeroNFe)
    {
        $this->numeroNFe = $numeroNFe;
    }
}