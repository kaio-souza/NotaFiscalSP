<?php
namespace NotaFiscalSP\Entities;

/**
 * Class RpsData
 * @package NotaFiscalSP\Entities
 */
class RpsData{
    /**
     * @var
     */
    private $serieRPS;
    /**
     * @var
     */
    private $numeroRPS;
    /**
     * @var
     */
    private $tipoRPS;
    /**
     * @var
     */
    private $dataEmissao;
    /**
     * @var
     */
    private $statusRPS;
    /**
     * @var
     */
    private $tributacaoRPS;
    /**
     * @var
     */
    private $valorServicos;
    /**
     * @var
     */
    private $valorDeducoes;
    /**
     * @var
     */
    private $codigoServico;
    /**
     * @var
     */
    private $aliquotaServicos;
    /**
     * @var
     */
    private $issRetido;
    /**
     * @var
     */
    private $cpfCnpjTomador;
    /**
     * @var
     */
    private $razaoSocialTomador;
    /**
     * @var
     */
    private $tipoLogradouro;
    /**
     * @var
     */
    private $logradouro;
    /**
     * @var
     */
    private $numeroEndereco;
    /**
     * @var
     */
    private $complementoEndereco;
    /**
     * @var
     */
    private $bairro;
    /**
     * @var
     */
    private $cidade;
    /**
     * @var
     */
    private $uf;
    /**
     * @var
     */
    private $cep;
    /**
     * @var
     */
    private $emailTomador;
    /**
     * @var
     */
    private $discriminacao;
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
     * @return string
     */
    public function getContentString(){
        return sprintf( '%08s', $this->getAliquotaServicos() ) .
            sprintf('%-5s',$this->getSerieRPS() ) . // 5 chars
            sprintf( '%012s', $this->getNumeroRPS() ) .
            date( 'Ymd', $this->getDataEmissao() ) .
            $this->getTributacaoRPS() .
            $this->getStatusRPS() .
            ( ( $this->getIssRetido() ) ? 'S' : 'N' ) .
            sprintf( '%015s', str_replace( array( '.', ',' ),'', number_format( $this->getValorServicos(), 2 ) ) ).
            sprintf( '%015s', str_replace( array( '.', ',' ), '', number_format( $this->getValorDeducoes(), 2 ) ) ) .
            sprintf( '%05s', $this->getCodigoServico() ) .
            ( ( $this->getTipoRPS() == 'F' ) ? '1' : '2' ) .
            sprintf( '%014s', $this->getCpfCnpjTomador() );
    }
}