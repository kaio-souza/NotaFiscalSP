<?php

namespace NotaFiscalSP\Entities\Requests\NFTS;

use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Helpers\General;

class NftsLot implements UserRequest
{
    private $transacao;
    private $dtInicio;
    private $dtFim;
    private $qtdNFTS;
    private $valorTotalServicos;
    private $valorTotalDeducoes;
    private $nftsList;

    public function __construct()
    {
        $this->setTransacao('true');
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
        $this->transacao = $transacao ? 'true' : 'false';
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
    public function getQtdNFTS()
    {
        return $this->qtdNFTS;
    }

    /**
     * @param mixed $qtdNFTS
     */
    public function setQtdNFTS($qtdNFTS)
    {
        $this->qtdNFTS = $qtdNFTS;
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
    public function getNftsList()
    {
        return $this->nftsList;
    }

    /**
     * @param mixed $nftsList
     */
    public function setNftsList(array $nftsList)
    {
        $valorTotalServicos = 0;
        $valorTotalDeducoes = 0;

        foreach ($nftsList as $nfts) {
            if ($nfts instanceof Nfts) {
                $valorTotalServicos = $valorTotalServicos + $nfts->getValorServicos();
                $valorTotalDeducoes = $valorTotalDeducoes + $nfts->getValorDeducoes();
            }
        }

        $this->qtdNFTS = count($nftsList);
        $this->setValorTotalServicos($valorTotalServicos);
        $this->setValorTotalDeducoes($valorTotalDeducoes);

        $this->nftsList = $nftsList;
    }

    public function toArray()
    {
        return [
            HeaderEnum::TRANSACTION => $this->transacao,
            HeaderEnum::START_DATE => $this->dtInicio,
            HeaderEnum::END_DATE => $this->dtFim,
            HeaderEnum::NFTS_COUNT => $this->qtdNFTS,
            HeaderEnum::SERVICES_TOTAL => $this->valorTotalServicos,
            HeaderEnum::DEDUCTION_TOTAL => $this->valorTotalDeducoes,
            NftsEnum::NFTS => $this->nftsList,
        ];
    }
}