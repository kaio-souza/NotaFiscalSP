<?php

namespace NotaFiscalSP\Entities;

/**
 * Class RpsData
 * @package NotaFiscalSP\Entities
 */
class RpsData
{

    private $serieRPS;
    private $numeroRPS;
    private $tipoRPS;
    private $dataEmissao;
    private $statusRPS;
    private $tributacaoRPS;
    private $valorServicos;
    private $valorDeducoes;
    private $codigoServico;
    private $aliquotaServicos;
    private $issRetido;
    private $cpfTomador;
    private $cnpjTomador;
    private $inscricaoMunicipalTomador;
    private $inscricaoEstadualTomador;
    private $inscricaoMunicipalIntermediario;
    private $issRetidoIntermediario;
    private $emailIntermediario;
    private $cpfIntermediario;
    private $cnpjIntermediario;
    private $razaoSocialTomador;
    private $tipoLogradouro;
    private $logradouro;
    private $numeroEndereco;
    private $complementoEndereco;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $emailTomador;
    private $discriminacao;
    private $valorPIS;
    private $valorCOFINS;
    private $valorINSS;
    private $valorIR;
    private $valorCSLL;

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
    public function getCpfIntermediario()
    {
        return $this->cpfIntermediario;
    }

    /**
     * @param mixed $cpfIntermediario
     */
    public function setCpfIntermediario($cpfIntermediario)
    {
        $this->cpfIntermediario = $cpfIntermediario;
    }

    /**
     * @return mixed
     */
    public function getCnpjIntermediario()
    {
        return $this->cnpjIntermediario;
    }

    /**
     * @param mixed $cnpjIntermediario
     */
    public function setCnpjIntermediario($cnpjIntermediario)
    {
        $this->cnpjIntermediario = $cnpjIntermediario;
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

    public function getCpfCnpjIntermediario()
    {
        if ($this->cpfIntermediario) {
            return $this->cpfIntermediario;
        } else {
            return $this->cnpjIntermediario;
        }
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
    public function getCpfTomador()
    {
        return $this->cpfTomador;
    }

    /**
     * @param mixed $cpfCnpjTomador
     */

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
     * @return string
     */
    public function getContentString()
    {
        return sprintf('%08s', $this->getAliquotaServicos()) .
            sprintf('%-5s', $this->getSerieRPS()) . // 5 chars
            sprintf('%012s', $this->getNumeroRPS()) .
            date('Ymd', $this->getDataEmissao()) .
            $this->getTributacaoRPS() .
            $this->getStatusRPS() .
            (($this->getIssRetido()) ? 'S' : 'N') .
            sprintf('%015s', str_replace(array('.', ','), '', number_format($this->getValorServicos(), 2))) .
            sprintf('%015s', str_replace(array('.', ','), '', number_format($this->getValorDeducoes(), 2))) .
            sprintf('%05s', $this->getCodigoServico()) .
            (($this->getTipoRPS() == 'F') ? '1' : '2') .
            sprintf('%014s', $this->getCpfCnpjTomador());
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
    public function getTributacaoRPS()
    {
        return $this->tributacaoRPS;
    }

    /**
     * @param mixed $tributacaoRPS
     */
    public function setTributacaoRPS($tributacaoRPS)
    {
        $this->tributacaoRPS = $tributacaoRPS;
    }

    /**
     * @return mixed
     */
    public function getStatusRPS()
    {
        return $this->statusRPS;
    }

    /**
     * @param mixed $statusRPS
     */
    public function setStatusRPS($statusRPS)
    {
        $this->statusRPS = $statusRPS;
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
    public function getTipoRPS()
    {
        return $this->tipoRPS;
    }

    /**
     * @param mixed $tipoRPS
     */
    public function setTipoRPS($tipoRPS)
    {
        $this->tipoRPS = $tipoRPS;
    }

    /**
     * @return mixed
     */
    public function getCpfCnpjTomador()
    {
        if ($this->cpfTomador) {
            return $this->cpfTomador;
        } else {
            return $this->cnpjTomador;
        }
    }
}