<?php
namespace NotaFiscalSP\Entities\Requests;

use NotaFiscalSP\Constants\FieldData\RPSStatus;
use NotaFiscalSP\Constants\FieldData\RPSTaxType;
use NotaFiscalSP\Constants\FieldData\RPSType;
use NotaFiscalSP\Constants\Requests\RpsConstant;
use NotaFiscalSP\Constants\Requests\RpsConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;

class Rps{
    private $inscricaoPrestador;
    private $serieRps;
    private $numeroRps;
    private $tipoRps;
    private $dataEmissao;
    private $statusRps;
    private $tributacaoRps;
    private $valorServicos;
    private $valorDeducoes;
    private $valorPIS;
    private $valorCOFINS;
    private $valorINSS;
    private $valorIR;
    private $valorCSLL;
    private $codigoServico;
    private $aliquotaServicos;
    private $issRetido;
    private $inscricaoMunicipalTomador;
    private $inscricaoEstadualTomador;
    private $razaoSocialTomador;
    private $emailTomador;
    private $discriminacao;
    private $cpfcnpjTomador;
    private $cpfcnpjIntermediario;
    private $inscricaoMunicipalIntermediario;
    private $issRetidoIntermediario;
    private $emailIntermediario;
    private $valorCargaTributaria;
    private $percentualCargaTributaria;
    private $fonteCargaTributaria;
    private $codigoCEI;
    private $matriculaObra;
    private $municipioPrestacao;
    private $valortotalRecebido;
    private $numeroEncapsulamento;
    private $tipoLogradouro;
    private $logradouro;
    private $numeroEndereco;
    private $complementoEndereco;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $cpf;
    private $cnpj;

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function __construct()
    {
        $this->setTipoRps(RPSType::RECIBO_PROVISORIO);
        $this->setStatusRps(RPSStatus::NORMAL);
        $this->setDataEmissao(date('Y-m-d'));
        $this->setTributacaoRps(RPSTaxType::IN_SP);
        $this->setValorDeducoes(0);
        $this->setValorServicos(0);
        $this->setIssRetido(false);
        $this->setSerieRps('A');
        $this->setAliquotaServicos( '0');
    }

    public function getArray(){

        return [
            SimpleFieldsConstants::RPS_SERIES => $this->serieRps,
            SimpleFieldsConstants::IM_PROVIDER => $this->inscricaoPrestador,
            SimpleFieldsConstants::RPS_NUMBER => $this->numeroRps,
            RpsConstants::RPS_TYPE  => $this->tipoRps,
            RpsConstants::EMISSION_DATE  => $this->dataEmissao,
            RpsConstants::RPS_STATUS  => $this->statusRps,
            RpsConstants::RPS_TAX => $this->tributacaoRps,
            RpsConstants::SERVICE_VALUE  => $this->valorServicos,
            RpsConstants::DEDUCTION_VALUE => $this->valorDeducoes,
            RpsConstants::PIS_VALUE  => $this->valorPIS,
            RpsConstants::COFINS_VALUE  => $this->valorCOFINS,
            RpsConstants::INSS_VALUE  => $this->valorINSS,
            RpsConstants::IR_VALUE  => $this->valorIR,
            RpsConstants::CSLL_VALUE  => $this->valorCSLL,
            RpsConstants::SERVICE_CODE  => $this->codigoServico,
            RpsConstants::SERVICE_TAX => $this->aliquotaServicos,
            RpsConstants::ISS_RETENTION => $this->issRetido,
            RpsConstants::DISCRIMINATION  => $this->discriminacao,
            RpsConstants::CPFCNPJ_INTERMEDIARY  => $this->cpfcnpjIntermediario,
            RpsConstants::IM_INTERMEDIARY => $this->inscricaoMunicipalIntermediario,
            RpsConstants::ISS_RETENTION_INTERMEDIARY => $this->issRetidoIntermediario,
            RpsConstants::EMAIL_INTERMEDIARY => $this->emailIntermediario,
            RpsConstants::TAX_VALUE_INTERMEDIARY => $this->valorCargaTributaria,
            RpsConstants::TAX_PERCENT_INTERMEDIARY => $this->percentualCargaTributaria,
            RpsConstants::TAX_ORIGIN  => $this->fonteCargaTributaria,
            RpsConstants::CEI_CODE  => $this->codigoCEI,
            RpsConstants::WORK_REGISTRATION  => $this->matriculaObra,
            RpsConstants::CITY_INSTALLMENT  => $this->municipioPrestacao,
            RpsConstants::TOTAL_VALUE => $this->valortotalRecebido,
            RpsConstants::ENCAPSULATION_NUMBER  => $this->numeroEncapsulamento,
            RpsConstants::IM_TAKER  => $this->inscricaoMunicipalTomador,
            RpsConstants::IE_TAKER  => $this->inscricaoEstadualTomador,
            RpsConstants::CPFCNPJ_TAKER => $this->cpfcnpjTomador,
            RpsConstants::CORPORATE_NAME_TAKER  => $this->razaoSocialTomador,
            RpsConstants::EMAIL_TAKER  => $this->emailTomador,
            SimpleFieldsConstants::TYPE_ADDRESS=> $this->tipoLogradouro,
            SimpleFieldsConstants::ADDRESS => $this->logradouro,
            SimpleFieldsConstants::ADDRESS_NUMBER=> $this->numeroEndereco,
            SimpleFieldsConstants::ADDRESS_COMPLEMENT=> $this->complementoEndereco,
            SimpleFieldsConstants::NEIGHBORHOOD=> $this->bairro,
            SimpleFieldsConstants::CITY=> $this->cidade,
            SimpleFieldsConstants::STATE=> $this->uf,
            SimpleFieldsConstants::ZIP_CODE=> $this->cep,
            SimpleFieldsConstants::CPF=> $this->cpf,
            SimpleFieldsConstants::CNPJ=> $this->cnpj,
        ];
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
    public function getSerieRps()
    {
        return $this->serieRps;
    }

    /**
     * @param mixed $serieRps
     */
    public function setSerieRps($serieRps)
    {
        $this->serieRps = $serieRps;
    }

    /**
     * @return mixed
     */
    public function getNumeroRps()
    {
        return $this->numeroRps;
    }

    /**
     * @param mixed $numeroRps
     */
    public function setNumeroRps($numeroRps)
    {
        $this->numeroRps = $numeroRps;
    }

    /**
     * @return mixed
     */
    public function getTipoRps()
    {
        return $this->tipoRps;
    }

    /**
     * @param mixed $tipoRps
     */
    public function setTipoRps($tipoRps)
    {
        $this->tipoRps = $tipoRps;
    }

    /**
     * @return mixed
     */
    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    /**
     * @param mixed $dataEmissao
     */
    public function setDataEmissao($dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;
    }

    /**
     * @return mixed
     */
    public function getStatusRps()
    {
        return $this->statusRps;
    }

    /**
     * @param mixed $statusRps
     */
    public function setStatusRps($statusRps)
    {
        $this->statusRps = $statusRps;
    }

    /**
     * @return mixed
     */
    public function getTributacaoRps()
    {
        return $this->tributacaoRps;
    }

    /**
     * @param mixed $tributacaoRps
     */
    public function setTributacaoRps($tributacaoRps)
    {
        $this->tributacaoRps = $tributacaoRps;
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
    public function getValorPIS()
    {
        return $this->valorPIS;
    }

    /**
     * @param mixed $valorPIS
     */
    public function setValorPIS($valorPIS)
    {
        $this->valorPIS = $valorPIS;
    }

    /**
     * @return mixed
     */
    public function getValorCOFINS()
    {
        return $this->valorCOFINS;
    }

    /**
     * @param mixed $valorCOFINS
     */
    public function setValorCOFINS($valorCOFINS)
    {
        $this->valorCOFINS = $valorCOFINS;
    }

    /**
     * @return mixed
     */
    public function getValorINSS()
    {
        return $this->valorINSS;
    }

    /**
     * @param mixed $valorINSS
     */
    public function setValorINSS($valorINSS)
    {
        $this->valorINSS = $valorINSS;
    }

    /**
     * @return mixed
     */
    public function getValorIR()
    {
        return $this->valorIR;
    }

    /**
     * @param mixed $valorIR
     */
    public function setValorIR($valorIR)
    {
        $this->valorIR = $valorIR;
    }

    /**
     * @return mixed
     */
    public function getValorCSLL()
    {
        return $this->valorCSLL;
    }

    /**
     * @param mixed $valorCSLL
     */
    public function setValorCSLL($valorCSLL)
    {
        $this->valorCSLL = $valorCSLL;
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
    public function getIssRetido()
    {
        return $this->issRetido;
    }

    /**
     * @param mixed $issRetido
     */
    public function setIssRetido($issRetido)
    {
        $this->issRetido = $issRetido;
    }

    /**
     * @return mixed
     */
    public function getInscricaoMunicipalTomador()
    {
        return $this->inscricaoMunicipalTomador;
    }

    /**
     * @param mixed $inscricaoMunicipalTomador
     */
    public function setInscricaoMunicipalTomador($inscricaoMunicipalTomador)
    {
        $this->inscricaoMunicipalTomador = $inscricaoMunicipalTomador;
    }

    /**
     * @return mixed
     */
    public function getInscricaoEstadualTomador()
    {
        return $this->inscricaoEstadualTomador;
    }

    /**
     * @param mixed $inscricaoEstadualTomador
     */
    public function setInscricaoEstadualTomador($inscricaoEstadualTomador)
    {
        $this->inscricaoEstadualTomador = $inscricaoEstadualTomador;
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
    public function getEmailTomador()
    {
        return $this->emailTomador;
    }

    /**
     * @param mixed $emailTomador
     */
    public function setEmailTomador($emailTomador)
    {
        $this->emailTomador = $emailTomador;
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
    public function getCpfcnpjTomador()
    {
        return $this->cpfcnpjTomador;
    }

    /**
     * @param mixed $cpfcnpjTomador
     */
    public function setCpfcnpjTomador($cpfcnpjTomador)
    {
        $this->cpfcnpjTomador = $cpfcnpjTomador;
    }

    /**
     * @return mixed
     */
    public function getCpfcnpjIntermediario()
    {
        return $this->cpfcnpjIntermediario;
    }

    /**
     * @param mixed $cpfcnpjIntermediario
     */
    public function setCpfcnpjIntermediario($cpfcnpjIntermediario)
    {
        $this->cpfcnpjIntermediario = $cpfcnpjIntermediario;
    }

    /**
     * @return mixed
     */
    public function getInscricaoMunicipalIntermediario()
    {
        return $this->inscricaoMunicipalIntermediario;
    }

    /**
     * @param mixed $inscricaoMunicipalIntermediario
     */
    public function setInscricaoMunicipalIntermediario($inscricaoMunicipalIntermediario)
    {
        $this->inscricaoMunicipalIntermediario = $inscricaoMunicipalIntermediario;
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
    public function getEmailIntermediario()
    {
        return $this->emailIntermediario;
    }

    /**
     * @param mixed $emailIntermediario
     */
    public function setEmailIntermediario($emailIntermediario)
    {
        $this->emailIntermediario = $emailIntermediario;
    }

    /**
     * @return mixed
     */
    public function getValorCargaTributaria()
    {
        return $this->valorCargaTributaria;
    }

    /**
     * @param mixed $valorCargaTributaria
     */
    public function setValorCargaTributaria($valorCargaTributaria)
    {
        $this->valorCargaTributaria = $valorCargaTributaria;
    }

    /**
     * @return mixed
     */
    public function getPercentualCargaTributaria()
    {
        return $this->percentualCargaTributaria;
    }

    /**
     * @param mixed $percentualCargaTributaria
     */
    public function setPercentualCargaTributaria($percentualCargaTributaria)
    {
        $this->percentualCargaTributaria = $percentualCargaTributaria;
    }

    /**
     * @return mixed
     */
    public function getFonteCargaTributaria()
    {
        return $this->fonteCargaTributaria;
    }

    /**
     * @param mixed $fonteCargaTributaria
     */
    public function setFonteCargaTributaria($fonteCargaTributaria)
    {
        $this->fonteCargaTributaria = $fonteCargaTributaria;
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

    /**
     * @return mixed
     */
    public function getMunicipioPrestacao()
    {
        return $this->municipioPrestacao;
    }

    /**
     * @param mixed $municipioPrestacao
     */
    public function setMunicipioPrestacao($municipioPrestacao)
    {
        $this->municipioPrestacao = $municipioPrestacao;
    }

    /**
     * @return mixed
     */
    public function getValortotalRecebido()
    {
        return $this->valortotalRecebido;
    }

    /**
     * @param mixed $valortotalRecebido
     */
    public function setValortotalRecebido($valortotalRecebido)
    {
        $this->valortotalRecebido = $valortotalRecebido;
    }

    /**
     * @return mixed
     */
    public function getNumeroEncapsulamento()
    {
        return $this->numeroEncapsulamento;
    }

    /**
     * @param mixed $numeroEncapsulamento
     */
    public function setNumeroEncapsulamento($numeroEncapsulamento)
    {
        $this->numeroEncapsulamento = $numeroEncapsulamento;
    }

    /**
     * @return mixed
     */
    public function getTipoLogradouro()
    {
        return $this->tipoLogradouro;
    }

    /**
     * @param mixed $tipoLogradouro
     */
    public function setTipoLogradouro($tipoLogradouro)
    {
        $this->tipoLogradouro = $tipoLogradouro;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return mixed
     */
    public function getNumeroEndereco()
    {
        return $this->numeroEndereco;
    }

    /**
     * @param mixed $numeroEndereco
     */
    public function setNumeroEndereco($numeroEndereco)
    {
        $this->numeroEndereco = $numeroEndereco;
    }

    /**
     * @return mixed
     */
    public function getComplementoEndereco()
    {
        return $this->complementoEndereco;
    }

    /**
     * @param mixed $complementoEndereco
     */
    public function setComplementoEndereco($complementoEndereco)
    {
        $this->complementoEndereco = $complementoEndereco;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }
}