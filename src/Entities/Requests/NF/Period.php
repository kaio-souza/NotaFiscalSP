<?php

namespace NotaFiscalSP\Entities\Requests\NF;


use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Helpers\General;

/**
 * Class Period
 * @package NotaFiscalSP\Entities\Requests
 */
class Period implements UserRequest
{

    public $cpf;
    public $cnpj;
    public $inscricaoMunicipal;
    public $dtInicio;
    public $dtFim;
    public $pagina;
    public $transacao;

    public function __construct()
    {
        $this->transacao = 'false';
        $this->pagina = 1;
        $this->dtInicio = date('Y-m-d');
        $this->dtFim = date('Y-m-d');
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }


    /**
     * @param $cpf
     * @return $this
     */
    public function setCpf($cpf)
    {
        $this->cpf = sprintf('%011s', General::onlyNumbers($cpf));
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }


    /**
     * @param $cnpj
     * @return $this
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = sprintf('%014s',General::onlyNumbers($cnpj));
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
    }


    /**
     * @param $inscricaoMunicipal
     * @return $this
     */
    public function setInscricaoMunicipal($inscricaoMunicipal)
    {
        $this->inscricaoMunicipal = $inscricaoMunicipal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtInicio()
    {
        return $this->dtInicio;
    }


    /**
     * @param $dtInicio
     * @return $this
     */
    public function setDtInicio($dtInicio)
    {
        $this->dtInicio = General::filterDate($dtInicio);
        return $this;

    }

    /**
     * @return mixed
     */
    public function getDtFim()
    {
        return $this->dtFim;
    }


    /**
     * @param $dtFim
     * @return $this
     */
    public function setDtFim($dtFim)
    {

        $this->dtFim = General::filterDate($dtFim);
        return $this;

    }

    /**
     * @return mixed
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * @param $pagina
     * @return $this
     */
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getTransacao()
    {
        return $this->transacao;
    }


    /**
     * @param $transacao
     * @return $this
     */
    public function setTransacao($transacao)
    {
        $this->transacao = $transacao;
        return $this;

    }

    public function toArray()
    {
        return [
            SimpleFieldsEnum::CPF => $this->cpf,
            SimpleFieldsEnum::CNPJ => $this->cnpj,
            HeaderEnum::IM => $this->inscricaoMunicipal,
            HeaderEnum::START_DATE => $this->dtInicio,
            HeaderEnum::END_DATE => $this->dtFim,
            HeaderEnum::PAGE_NUMBER => $this->pagina,
            HeaderEnum::TRANSACTION => $this->transacao,
        ];
    }
}