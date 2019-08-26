<?php

namespace NotaFiscalSP\Entities\Requests\NF;

use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Helpers\General;

class Lot implements UserRequest
{
    private $transacao;
    private $dtInicio;
    private $dtFim;
    private $qtdRPS;
    private $valorTotalServicos;
    private $valorTotalDeducoes;
    private $rpsList;

    public function __construct()
    {
        $this->setTransacao(true);
        $this->setDtInicio(date('Y-m-d'));
        $this->setDtFim(date('Y-m-d'));
    }

    /**
     * @return mixed
     */
    public function getValorTotalDeducoes()
    {
        return $this->valorTotalDeducoes;
    }

    /**
     * @param mixed $valorTotalDeducoes
     */
    public function setValorTotalDeducoes($valorTotalDeducoes)
    {
        $this->valorTotalDeducoes = $valorTotalDeducoes;
    }

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
    public function getDtInicio()
    {
        return $this->dtInicio;
    }

    /**
     * @param mixed $dtInicio
     */
    public function setDtInicio($dtInicio)
    {
        $this->dtInicio = General::filterDate($dtInicio);
    }

    /**
     * @return mixed
     */
    public function getDtFim()
    {
        return $this->dtFim;
    }

    /**
     * @param mixed $dtFim
     */
    public function setDtFim($dtFim)
    {
        $this->dtFim = General::filterDate($dtFim);
    }

    /**
     * @return mixed
     */
    public function getQtdRPS()
    {
        return $this->qtdRPS;
    }

    /**
     * @param mixed $qtdRPS
     */
    public function setQtdRPS($qtdRPS)
    {
        $this->qtdRPS = $qtdRPS;
    }

    /**
     * @return mixed
     */
    public function getValorTotalServicos()
    {
        return $this->valorTotalServicos;
    }

    /**
     * @param mixed $valorTotalServicos
     */
    public function setValorTotalServicos($valorTotalServicos)
    {
        $this->valorTotalServicos = $valorTotalServicos;
    }

    /**
     * @return mixed
     */
    public function getRpsList()
    {
        return $this->rpsList;
    }

    /**
     * @param mixed $rpsList
     */
    public function setRpsList(array $rpsList)
    {
        $valorTotalServicos = 0;
        $valorTotalDeducoes = 0;

        foreach ($rpsList as $rps) {
            if ($rps instanceof Rps) {
                $valorTotalServicos = $valorTotalServicos + $rps->getValorServicos();
                $valorTotalDeducoes = $valorTotalDeducoes + $rps->getValorDeducoes();
            }
        }

        $this->qtdRPS = count($rpsList);
        $this->setValorTotalServicos($valorTotalServicos);
        $this->setValorTotalDeducoes($valorTotalDeducoes);

        $this->rpsList = $rpsList;
    }

    public function toArray()
    {
        return [
            HeaderEnum::TRANSACTION => $this->transacao,
            HeaderEnum::START_DATE => $this->dtInicio,
            HeaderEnum::END_DATE => $this->dtFim,
            HeaderEnum::RPS_COUNT => $this->qtdRPS,
            HeaderEnum::SERVICES_TOTAL => $this->valorTotalServicos,
            HeaderEnum::DEDUCTION_TOTAL => $this->valorTotalDeducoes,
            RpsEnum::RPS => $this->rpsList,
        ];
    }
}