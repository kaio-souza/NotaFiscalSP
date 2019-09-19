<?php

namespace NotaFiscalSP\Entities\Requests\NF;

use NotaFiscalSP\Constants\FieldData\RPSType;
use NotaFiscalSP\Constants\FieldData\Status;
use NotaFiscalSP\Constants\FieldData\TaxType;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Exceptions\InvalidParam;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Validators\RpsValidator;

class Rps implements UserRequest
{
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
    private $cpfCnpjTomador;
    private $cpfIntermediario;
    private $cnpjIntermediario;
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

    public function __construct()
    {
        $this->setTipoRps(RPSType::RECIBO_PROVISORIO);
        $this->setStatusRps(Status::NORMAL);
        $this->setDataEmissao(date('Y-m-d'));
        $this->setTributacaoRps(TaxType::IN_SP);
        $this->setValorDeducoes(0);
        $this->setValorServicos(0);
        $this->setIssRetido(false);
        $this->setSerieRps('A');
        $this->setAliquotaServicos('0');
//        $this->setCidade(3550308); // SP CODE
    }

    public function toArray()
    {

        return [
            SimpleFieldsEnum::RPS_SERIES => $this->serieRps,
            SimpleFieldsEnum::IM_PROVIDER => $this->inscricaoPrestador,
            SimpleFieldsEnum::RPS_NUMBER => $this->numeroRps,
            RpsEnum::RPS_TYPE => $this->tipoRps,
            RpsEnum::EMISSION_DATE => $this->dataEmissao,
            RpsEnum::RPS_STATUS => $this->statusRps,
            RpsEnum::RPS_TAX => $this->tributacaoRps,
            RpsEnum::SERVICE_VALUE => $this->valorServicos,
            RpsEnum::DEDUCTION_VALUE => $this->valorDeducoes,
            RpsEnum::PIS_VALUE => $this->valorPIS,
            RpsEnum::COFINS_VALUE => $this->valorCOFINS,
            RpsEnum::INSS_VALUE => $this->valorINSS,
            RpsEnum::IR_VALUE => $this->valorIR,
            RpsEnum::CSLL_VALUE => $this->valorCSLL,
            RpsEnum::SERVICE_CODE => $this->codigoServico,
            RpsEnum::SERVICE_TAX => $this->aliquotaServicos,
            RpsEnum::ISS_RETENTION => $this->issRetido,
            RpsEnum::DISCRIMINATION => $this->discriminacao,
            RpsEnum::CPFCNPJ_INTERMEDIARY => $this->cpfIntermediario,
            RpsEnum::IM_INTERMEDIARY => $this->inscricaoMunicipalIntermediario,
            RpsEnum::ISS_RETENTION_INTERMEDIARY => $this->issRetidoIntermediario,
            RpsEnum::EMAIL_INTERMEDIARY => $this->emailIntermediario,
            RpsEnum::TAX_VALUE_INTERMEDIARY => $this->valorCargaTributaria,
            RpsEnum::TAX_PERCENT_INTERMEDIARY => $this->percentualCargaTributaria,
            RpsEnum::TAX_ORIGIN => $this->fonteCargaTributaria,
            RpsEnum::CEI_CODE => $this->codigoCEI,
            RpsEnum::WORK_REGISTRATION => $this->matriculaObra,
            RpsEnum::CITY_INSTALLMENT => $this->municipioPrestacao,
            RpsEnum::TOTAL_VALUE => $this->valortotalRecebido,
            RpsEnum::ENCAPSULATION_NUMBER => $this->numeroEncapsulamento,
            RpsEnum::IM_TAKER => $this->inscricaoMunicipalTomador,
            RpsEnum::IE_TAKER => $this->inscricaoEstadualTomador,
            RpsEnum::CPFCNPJ_TAKER => $this->cpfCnpjTomador,
            RpsEnum::CORPORATE_NAME_TAKER => $this->razaoSocialTomador,
            RpsEnum::EMAIL_TAKER => $this->emailTomador,
            SimpleFieldsEnum::TYPE_ADDRESS => $this->tipoLogradouro,
            SimpleFieldsEnum::ADDRESS => $this->logradouro,
            SimpleFieldsEnum::ADDRESS_NUMBER => $this->numeroEndereco,
            SimpleFieldsEnum::ADDRESS_COMPLEMENT => $this->complementoEndereco,
            SimpleFieldsEnum::NEIGHBORHOOD => $this->bairro,
            SimpleFieldsEnum::CITY => $this->cidade,
            SimpleFieldsEnum::STATE => $this->uf,
            SimpleFieldsEnum::ZIP_CODE => $this->cep,
            SimpleFieldsEnum::CPF => $this->cpf,
            SimpleFieldsEnum::CNPJ => $this->cnpj,
        ];
    }

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
        $this->cpf = sprintf('%011s', General::onlyNumbers($cpf));
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
        $this->cnpj = sprintf('%014s', General::onlyNumbers($cnpj));
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
        $this->inscricaoPrestador = sprintf('%08s', $inscricaoPrestador);
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
        $this->serieRps = substr($serieRps, 0, 5);
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
        $this->numeroRps = General::onlyNumbers($numeroRps);
    }

    /**
     * @return mixed
     */
    public function getTipoRps()
    {
        return $this->tipoRps;
    }

    /**
     * @param $tipoRps
     * @throws InvalidParam
     */
    public function setTipoRps($tipoRps)
    {
        RpsValidator::validateRpsType($tipoRps);
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
        $this->dataEmissao = General::filterDate($dataEmissao);
    }

    /**
     * @return mixed
     */
    public function getStatusRps()
    {
        return $this->statusRps;
    }

    /**
     * @param $statusRps
     * @throws InvalidParam
     */
    public function setStatusRps($statusRps)
    {
        RpsValidator::validateRpsStatus($statusRps);
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
        $this->tributacaoRps = substr($tributacaoRps, 0, 1);
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
        $this->inscricaoMunicipalTomador = sprintf('%08s', $inscricaoMunicipalTomador);
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

        $this->inscricaoEstadualTomador = substr(General::onlyNumbers($inscricaoEstadualTomador), 0, 19);
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
        $this->razaoSocialTomador = substr($razaoSocialTomador, 0, 75);
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
        $this->emailTomador = substr($emailTomador, 0, 30);
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
        $this->discriminacao = substr($discriminacao, 0, 2000);
    }

    /**
     * @return mixed
     */
    public function getCpfCnpjTomador()
    {
        return $this->cpfCnpjTomador;
    }

    /**
     * @param mixed $cpfCnpjTomador
     */
    public function setCpfCnpjTomador($cpfCnpjTomador)
    {
        $this->cpfCnpjTomador = $cpfCnpjTomador;
    }

    /**
     * @return mixed
     */
    public function getCpfIntermediario()
    {
        return $this->cpfIntermediario;
    }

    /**
     * @param mixed $cpfIntermediario
     */
    public function setCpfIntermediario($cpfIntermediario)
    {
        $this->cpfIntermediario = sprintf('%011s', General::onlyNumbers($cpfIntermediario));
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
        $this->inscricaoMunicipalIntermediario = sprintf('%08s',$inscricaoMunicipalIntermediario);
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
        $this->emailIntermediario = substr($emailIntermediario, 0, 75);
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
        $this->fonteCargaTributaria = substr($fonteCargaTributaria,0,10);
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
        $this->codigoCEI = General::onlyNumbers($codigoCEI);
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
        $this->matriculaObra = General::onlyNumbers($matriculaObra);
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
        $this->municipioPrestacao = sprintf('%07s', General::onlyNumbers($municipioPrestacao));
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
        $this->numeroEncapsulamento = General::onlyNumbers($numeroEncapsulamento);
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
        $this->tipoLogradouro = substr($tipoLogradouro,0,3);
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
        $this->logradouro = substr($logradouro, 0,50);
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
        $this->numeroEndereco = General::onlyNumbers($numeroEndereco);
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
        $this->complementoEndereco = substr($complementoEndereco, 0, 30);
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
        $this->bairro = substr($bairro, 0, 30);
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

        $this->cidade = sprintf('%07s', General::onlyNumbers($cidade));
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
        $this->uf = substr($uf,0,2);
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
        $this->cep = sprintf('%08s', General::onlyNumbers($cep));
    }
}