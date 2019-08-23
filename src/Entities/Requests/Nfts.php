<?php

namespace NotaFiscalSP\Entities\Requests;

use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;

class Nfts implements UserRequest
{
    private $tipoDocumento;
    private $dataPrestacao;
    private $statusNFTS;
    private $tributacaoNFTS;
    private $valorServicos;
    private $valorDeducoes;
    private $codigoServico;
    private $codigoSubItem;
    private $aliquotaServicos;
    private $issRetidoTomador;
    private $issRetidoIntermediario;
    private $descumpreLeiComplementar1572016;
    private $cpfPrestador;
    private $cnpjPrestador;
    private $inscricaoMunicipalPrestador;
    private $emailPrestador;
    private $regimeTributacao;
    private $dataPagamento;
    private $discriminacao;
    private $tipoNFTS;
    private $cpfTomador;
    private $cnpjTomador;
    private $razaoSocialTomador;
    private $codigoCEI;
    private $matriculaObra;

    /**
     * @return mixed
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * @param mixed $tipoDocumento
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    /**
     * @return mixed
     */
    public function getDataPrestacao()
    {
        return $this->dataPrestacao;
    }

    /**
     * @param mixed $dataPrestacao
     */
    public function setDataPrestacao($dataPrestacao)
    {
        $this->dataPrestacao = $dataPrestacao;
    }

    /**
     * @return mixed
     */
    public function getStatusNFTS()
    {
        return $this->statusNFTS;
    }

    /**
     * @param mixed $statusNFTS
     */
    public function setStatusNFTS($statusNFTS)
    {
        $this->statusNFTS = $statusNFTS;
    }

    /**
     * @return mixed
     */
    public function getTributacaoNFTS()
    {
        return $this->tributacaoNFTS;
    }

    /**
     * @param mixed $tributacaoNFTS
     */
    public function setTributacaoNFTS($tributacaoNFTS)
    {
        $this->tributacaoNFTS = $tributacaoNFTS;
    }

    /**
     * @return mixed
     */
    public function getValorServicos()
    {
        return $this->valorServicos;
    }

    /**
     * @param mixed $valorServicos
     */
    public function setValorServicos($valorServicos)
    {
        $this->valorServicos = $valorServicos;
    }

    /**
     * @return mixed
     */
    public function getValorDeducoes()
    {
        return $this->valorDeducoes;
    }

    /**
     * @param mixed $valorDeducoes
     */
    public function setValorDeducoes($valorDeducoes)
    {
        $this->valorDeducoes = $valorDeducoes;
    }

    /**
     * @return mixed
     */
    public function getCodigoServico()
    {
        return $this->codigoServico;
    }

    /**
     * @param mixed $codigoServico
     */
    public function setCodigoServico($codigoServico)
    {
        $this->codigoServico = $codigoServico;
    }

    /**
     * @return mixed
     */
    public function getCodigoSubItem()
    {
        return $this->codigoSubItem;
    }

    /**
     * @param mixed $codigoSubItem
     */
    public function setCodigoSubItem($codigoSubItem)
    {
        $this->codigoSubItem = $codigoSubItem;
    }

    /**
     * @return mixed
     */
    public function getAliquotaServicos()
    {
        return $this->aliquotaServicos;
    }

    /**
     * @param mixed $aliquotaServicos
     */
    public function setAliquotaServicos($aliquotaServicos)
    {
        $this->aliquotaServicos = $aliquotaServicos;
    }

    /**
     * @return mixed
     */
    public function getIssRetidoTomador()
    {
        return $this->issRetidoTomador;
    }

    /**
     * @param mixed $issRetidoTomador
     */
    public function setIssRetidoTomador($issRetidoTomador)
    {
        $this->issRetidoTomador = $issRetidoTomador;
    }

    /**
     * @return mixed
     */
    public function getIssRetidoIntermediario()
    {
        return $this->issRetidoIntermediario;
    }

    /**
     * @param mixed $issRetidoIntermediario
     */
    public function setIssRetidoIntermediario($issRetidoIntermediario)
    {
        $this->issRetidoIntermediario = $issRetidoIntermediario;
    }

    /**
     * @return mixed
     */
    public function getDescumpreLeiComplementar1572016()
    {
        return $this->descumpreLeiComplementar1572016;
    }

    /**
     * @param mixed $descumpreLeiComplementar1572016
     */
    public function setDescumpreLeiComplementar1572016($descumpreLeiComplementar1572016)
    {
        $this->descumpreLeiComplementar1572016 = $descumpreLeiComplementar1572016;
    }

    /**
     * @return mixed
     */
    public function getCpfPrestador()
    {
        return $this->cpfPrestador;
    }

    /**
     * @param mixed $cpfPrestador
     */
    public function setCpfPrestador($cpfPrestador)
    {
        $this->cpfPrestador = $cpfPrestador;
    }

    /**
     * @return mixed
     */
    public function getCnpjPrestador()
    {
        return $this->cnpjPrestador;
    }

    /**
     * @param mixed $cnpjPrestador
     */
    public function setCnpjPrestador($cnpjPrestador)
    {
        $this->cnpjPrestador = $cnpjPrestador;
    }

    /**
     * @return mixed
     */
    public function getInscricaoMunicipalPrestador()
    {
        return $this->inscricaoMunicipalPrestador;
    }

    /**
     * @param mixed $inscricaoMunicipalPrestador
     */
    public function setInscricaoMunicipalPrestador($inscricaoMunicipalPrestador)
    {
        $this->inscricaoMunicipalPrestador = $inscricaoMunicipalPrestador;
    }

    /**
     * @return mixed
     */
    public function getEmailPrestador()
    {
        return $this->emailPrestador;
    }

    /**
     * @param mixed $emailPrestador
     */
    public function setEmailPrestador($emailPrestador)
    {
        $this->emailPrestador = $emailPrestador;
    }

    /**
     * @return mixed
     */
    public function getRegimeTributacao()
    {
        return $this->regimeTributacao;
    }

    /**
     * @param mixed $regimeTributacao
     */
    public function setRegimeTributacao($regimeTributacao)
    {
        $this->regimeTributacao = $regimeTributacao;
    }

    /**
     * @return mixed
     */
    public function getDataPagamento()
    {
        return $this->dataPagamento;
    }

    /**
     * @param mixed $dataPagamento
     */
    public function setDataPagamento($dataPagamento)
    {
        $this->dataPagamento = $dataPagamento;
    }

    /**
     * @return mixed
     */
    public function getDiscriminacao()
    {
        return $this->discriminacao;
    }

    /**
     * @param mixed $discriminacao
     */
    public function setDiscriminacao($discriminacao)
    {
        $this->discriminacao = $discriminacao;
    }

    /**
     * @return mixed
     */
    public function getTipoNFTS()
    {
        return $this->tipoNFTS;
    }

    /**
     * @param mixed $tipoNFTS
     */
    public function setTipoNFTS($tipoNFTS)
    {
        $this->tipoNFTS = $tipoNFTS;
    }

    /**
     * @return mixed
     */
    public function getCpfTomador()
    {
        return $this->cpfTomador;
    }

    /**
     * @param mixed $cpfTomador
     */
    public function setCpfTomador($cpfTomador)
    {
        $this->cpfTomador = $cpfTomador;
    }

    /**
     * @return mixed
     */
    public function getCnpjTomador()
    {
        return $this->cnpjTomador;
    }

    /**
     * @param mixed $cnpjTomador
     */
    public function setCnpjTomador($cnpjTomador)
    {
        $this->cnpjTomador = $cnpjTomador;
    }

    /**
     * @return mixed
     */
    public function getRazaoSocialTomador()
    {
        return $this->razaoSocialTomador;
    }

    /**
     * @param mixed $razaoSocialTomador
     */
    public function setRazaoSocialTomador($razaoSocialTomador)
    {
        $this->razaoSocialTomador = $razaoSocialTomador;
    }

    /**
     * @return mixed
     */
    public function getCodigoCEI()
    {
        return $this->codigoCEI;
    }

    /**
     * @param mixed $codigoCEI
     */
    public function setCodigoCEI($codigoCEI)
    {
        $this->codigoCEI = $codigoCEI;
    }

    /**
     * @return mixed
     */
    public function getMatriculaObra()
    {
        return $this->matriculaObra;
    }

    /**
     * @param mixed $matriculaObra
     */
    public function setMatriculaObra($matriculaObra)
    {
        $this->matriculaObra = $matriculaObra;
    }

    public function toArray()
    {
        return [
            NftsEnum::DOCUMENT_TYPE => $this->tipoDocumento,
            NftsEnum::DELIVERY_DATE => $this->dataPrestacao,
            NftsEnum::STATUS => $this->statusNFTS,
            NftsEnum::NFTS_TAX => $this->tributacaoNFTS,
            NftsEnum::SERVICE_VALUE => $this->valorServicos,
            NftsEnum::DEDUCTIONS_VALUE => $this->valorDeducoes,
            NftsEnum::SERVICE_CODE => $this->codigoServico,
            NftsEnum::SUB_ITEM_CODE => $this->codigoSubItem,
            NftsEnum::SERVICE_TAX => $this->aliquotaServicos,
            NftsEnum::ISS_TAKER => $this->issRetidoTomador,
            NftsEnum::ISS_INTERMEDIARY => $this->issRetidoIntermediario,
            NftsEnum::IGNORES_LAW_1572016 => $this->descumpreLeiComplementar1572016,
            SimpleFieldsEnum::CPF => $this->cpfPrestador,
            SimpleFieldsEnum::CNPJ => $this->cnpjPrestador,
            NftsEnum::IM => $this->inscricaoMunicipalPrestador,
            NftsEnum::TAXATION_REGIME => $this->regimeTributacao,
            NftsEnum::PAYMENT_DATE => $this->dataPagamento,
            NftsEnum::DISCRIMINATION => $this->discriminacao,
            NftsEnum::TYPE => $this->tipoNFTS,
            SimpleFieldsEnum::CPF_TAKER => $this->cpfTomador,
            SimpleFieldsEnum::CNPJ_TAKER => $this->cnpjTomador,
            SimpleFieldsEnum::CORPORATE_NAME_TAKER => $this->razaoSocialTomador,
            NftsEnum::CEI_CODE => $this->codigoCEI,
            NftsEnum::WORK_REGISTRATION => $this->matriculaObra,
        ];
    }
}