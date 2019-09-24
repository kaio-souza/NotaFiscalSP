<?php

namespace NotaFiscalSP\Entities\Requests\NFTS;

use NotaFiscalSP\Constants\FieldData\BooleanFields;
use NotaFiscalSP\Constants\FieldData\DocumentType;
use NotaFiscalSP\Constants\FieldData\NFTSTaxType;
use NotaFiscalSP\Constants\FieldData\NFTSType;
use NotaFiscalSP\Constants\FieldData\RegimeTributation;
use NotaFiscalSP\Constants\FieldData\Status;
use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Helpers\General;

class Nfts implements UserRequest
{
    private $tipoDocumento;
    private $dataPrestacao;
    private $statusNFTS;
    private $tributacaoNFTS;
    private $valorServicos;
    private $serieNFTS;
    private $numeroDocumento;
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
    private $complement;
    private $razaoSocialPrestador;
    private $tipoLogradouroPrestador;
    private $logradouroPrestador;
    private $cidadePrestador;
    private $numeroEnderecoPrestador;
    private $bairroPrestador;
    private $ufPrestador;
    private $cepPrestador;

    public function __construct()
    {
        $this->setTipoNFTS(NFTSType::TAKER);
        $this->setTributacaoNFTS(NFTSTaxType::NORMAL);
        $this->setValorDeducoes(0);
        $this->setValorServicos(0);
        $this->setAliquotaServicos(0.5);
        $this->setDataPrestacao(date('Y-m-d'));
        $this->setTipoDocumento(DocumentType::REQUIRED_EMISSION_FISCAL_DOCUMENT);
        $this->setStatusNFTS(Status::NORMAL);
        $this->setIssRetidoTomador(false);
        $this->setRegimeTributacao(RegimeTributation::NORMAL);
    }

    /**
     * @return mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param mixed $complement
     */
    public function setComplement($complement)
    {
        if(!empty($complement)){
            $this->complement = General::filterString($complement);
        }
    }

    /**
     * @return mixed
     */
    public function getCepPrestador()
    {
        return $this->cepPrestador;
    }

    /**
     * @param mixed $cepPrestador
     */
    public function setCepPrestador($cepPrestador)
    {
        $this->cepPrestador = General::onlyNumbers($cepPrestador);
    }

    /**
     * @return mixed
     */
    public function getRazaoSocialPrestador()
    {
        return $this->razaoSocialPrestador;
    }

    /**
     * @param mixed $razaoSocialPrestador
     */
    public function setRazaoSocialPrestador($razaoSocialPrestador)
    {
        $this->razaoSocialPrestador = General::filterString(substr($razaoSocialPrestador, 0, 75));
    }

    /**
     * @return mixed
     */
    public function getTipoLogradouroPrestador()
    {
        return $this->tipoLogradouroPrestador;
    }

    /**
     * @param mixed $tipoLogradouroPrestador
     */
    public function setTipoLogradouroPrestador($tipoLogradouroPrestador)
    {
        $this->tipoLogradouroPrestador = General::filterString(substr($tipoLogradouroPrestador, 0, 3));
    }

    /**
     * @return mixed
     */
    public function getLogradouroPrestador()
    {
        return $this->logradouroPrestador;
    }

    /**
     * @param mixed $logradouroPrestador
     */
    public function setLogradouroPrestador($logradouroPrestador)
    {
        $this->logradouroPrestador = General::filterString(substr($logradouroPrestador, 0, 50));
    }

    /**
     * @return mixed
     */
    public function getCidadePrestador()
    {
        return $this->cidadePrestador;
    }

    /**
     * @param mixed $cidadePrestador
     */
    public function setCidadePrestador($cidadePrestador)
    {
        $this->cidadePrestador = General::filterString($cidadePrestador);
    }

    /**
     * @return mixed
     */
    public function getNumeroEnderecoPrestador()
    {
        return $this->numeroEnderecoPrestador;
    }

    /**
     * @param mixed $numeroEnderecoPrestador
     */
    public function setNumeroEnderecoPrestador($numeroEnderecoPrestador)
    {
        $value = General::onlyNumbers($numeroEnderecoPrestador);
        if($value > 0){
            $this->numeroEnderecoPrestador = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getBairroPrestador()
    {
        return $this->bairroPrestador;
    }

    /**
     * @param mixed $bairroPrestador
     */
    public function setBairroPrestador($bairroPrestador)
    {
        $this->bairroPrestador = General::filterString(substr($bairroPrestador, 0, 30));
    }

    /**
     * @return mixed
     */
    public function getUfPrestador()
    {
        return $this->ufPrestador;
    }

    /**
     * @param mixed $ufPrestador
     */
    public function setUfPrestador($ufPrestador)
    {
        $this->ufPrestador = strtoupper(substr($ufPrestador, 0, 2));
    }


    /**
     * @return mixed
     */
    public function getSerieNFTS()
    {
        return $this->serieNFTS;
    }

    /**
     * @param mixed $serieNFTS
     */
    public function setSerieNFTS($serieNFTS)
    {
        $this->serieNFTS = substr($serieNFTS, 0, 5);
    }

    /**
     * @return mixed
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * @param mixed $numeroDocumento
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = sprintf('%012s', General::onlyNumbers($numeroDocumento));
    }

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
        $this->dataPrestacao = General::filterDate($dataPrestacao);
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
        $this->valorServicos = General::filterMonetaryValue($valorServicos);
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
        $this->valorDeducoes = General::filterMonetaryValue($valorDeducoes);
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
        $value = $issRetidoTomador ? BooleanFields::LOWER_TRUE : BooleanFields::LOWER_FALSE;
        $this->issRetidoTomador = $value;
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
        $value = $issRetidoIntermediario ? BooleanFields::CAP_TRUE : BooleanFields::CAP_FALSE;
        $this->issRetidoIntermediario = $value;
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
        $value = $descumpreLeiComplementar1572016 ? BooleanFields::LOWER_TRUE : BooleanFields::LOWER_FALSE;
        $this->descumpreLeiComplementar1572016 = $value;
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
        $this->cpfPrestador = sprintf('%011s', General::onlyNumbers($cpfPrestador));
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
        $this->cnpjPrestador = sprintf('%014s', General::onlyNumbers($cnpjPrestador));
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
        $this->inscricaoMunicipalPrestador = sprintf('%08s', $inscricaoMunicipalPrestador);
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
        if(!empty($emailPrestador)){
            $this->emailPrestador = $emailPrestador;
        }
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
        $this->dataPagamento = General::filterDate($dataPagamento);
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
        if(!empty($discriminacao)){
            $this->discriminacao = trim($discriminacao);
        }
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
        if(!empty($tipoNFTS)){
            $this->tipoNFTS = $tipoNFTS;
        }
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
        $this->cpfTomador = sprintf('%011s', General::onlyNumbers($cpfTomador));
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
        $this->cnpjTomador = sprintf('%011s', General::onlyNumbers($cnpjTomador));
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
        $this->razaoSocialTomador = General::filterString($razaoSocialTomador);
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
        if(!empty($codigoCEI)){
            $this->codigoCEI = $codigoCEI;
        }
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
        if(!empty($matriculaObra)){
            $this->matriculaObra = $matriculaObra;
        }
    }

    public function toArray()
    {
        return [
            NftsEnum::DOCUMENT_TYPE => $this->tipoDocumento,
            NftsEnum::DELIVERY_DATE => $this->dataPrestacao,
            NftsEnum::STATUS => $this->statusNFTS,
            NftsEnum::NFTS_SERIES => $this->serieNFTS,
            NftsEnum::DOCUMENT_NUMBER => $this->numeroDocumento,
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
            NftsEnum::CORPORATE_NAME_PROVIDER => $this->razaoSocialPrestador,
            NftsEnum::EMAIL_PROVIDER => $this->emailPrestador,
            SimpleFieldsEnum::TYPE_ADDRESS => $this->tipoLogradouroPrestador,
            SimpleFieldsEnum::ADDRESS => $this->logradouroPrestador,
            SimpleFieldsEnum::ADDRESS_NUMBER => $this->numeroEnderecoPrestador,
            SimpleFieldsEnum::ADDRESS_COMPLEMENT => $this->complement,
            SimpleFieldsEnum::NEIGHBORHOOD => $this->bairroPrestador,
            SimpleFieldsEnum::CITY => $this->cidadePrestador,
            SimpleFieldsEnum::STATE => $this->ufPrestador,
            SimpleFieldsEnum::ZIP_CODE => $this->cepPrestador,
        ];
    }
}
