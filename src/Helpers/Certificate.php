<?php

namespace NotaFiscalSP\Helpers;

use Exception;
use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;
use Greenter\XMLSecLibs\Sunat\SignedXml;
use NotaFiscalSP\Constants\FieldData\BooleanFields;
use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;

/**
 * Class Certificate
 * @package NotaFiscalSP\Helpers
 */
class Certificate
{
    /**
     * @param $path
     * @param $pass
     * @return string
     * @throws Exception
     */
    public static function pfx2pem($path, $pass)
    {
        // Get File
        $pfx = file_get_contents($path);

        // Export PEM
        $certificate = new X509Certificate($pfx, $pass);
        $pem = $certificate->export(X509ContentType::PEM);

        return $pem;
    }

    /**
     * @param $pem
     * @param $xml
     * @return string
     */
    public static function signXmlWithCertificate($pem, $xml)
    {
        // Create Signed XML
        $signer = new SignedXml();

        // Sign XML
        $signer->setCertificate($pem);
        $xmlSigned = $signer->signXml($xml);

        // Return XML File Signed
        return $xmlSigned;
    }


    public static function signatureRpsItem(BaseInformation $baseInformation, $content)
    {
        $signatureValue = '';
        $pkeyId = openssl_get_privatekey($baseInformation->getCertificate());
        openssl_sign($content, $signatureValue, $pkeyId, OPENSSL_ALGO_SHA1);
        openssl_free_key($pkeyId);
        return base64_encode($signatureValue);
    }

    public static function rpsSignatureString($params)
    {
        $document = General::getKey($params, SimpleFieldsEnum::CNPJ) ? General::getKey($params, SimpleFieldsEnum::CNPJ) : General::getKey($params, SimpleFieldsEnum::CPF);
        //Required Fields
        $string =
            sprintf('%08s', General::getKey($params, SimpleFieldsEnum::IM_PROVIDER)) .
            sprintf('%-5s', General::getKey($params, SimpleFieldsEnum::RPS_SERIES)) . // 5 chars
            sprintf('%012s', General::getKey($params, SimpleFieldsEnum::RPS_NUMBER)) .
            str_replace('-', '', General::getKey($params, RpsEnum::EMISSION_DATE)) .
            General::getKey($params, RpsEnum::RPS_TAX) .
            General::getKey($params, RpsEnum::RPS_STATUS) .
            ($params[RpsEnum::ISS_RETENTION] == 'false' ? BooleanFields::FALSE : BooleanFields::TRUE) .
            sprintf('%015s', str_replace(array('.', ','), '', number_format(General::getKey($params, RpsEnum::SERVICE_VALUE), 2))) .
            sprintf('%015s', str_replace(array('.', ','), '', number_format(General::getKey($params, RpsEnum::DEDUCTION_VALUE), 2))) .
            sprintf('%05s', General::getKey($params, RpsEnum::SERVICE_CODE)) .
            ((General::getKey($params, SimpleFieldsEnum::CPF)) ? 1 : 2) .
            General::getKey($params, SimpleFieldsEnum::CPF) .
            sprintf('%014s', $document);

        // AVAILABLE ON RELEASE 2

        return $string;
    }

    public static function cancelSignatureString($params)
    {
        return sprintf('%08s', General::getKey($params, SimpleFieldsEnum::IM_PROVIDER)) .
            sprintf('%012s', General::getKey($params, SimpleFieldsEnum::NFE_NUMBER));
    }

    public static function makeNftsSignature($params)
    {
        $signature = "<tpNFTS>" .
            "<TipoDocumento>" . General::getKey($params, NftsEnum::DOCUMENT_TYPE) . "</TipoDocumento>" .
            "<ChaveDocumento>" .
            "<InscricaoMunicipal>" . General::getKey($params, NftsEnum::IM) . "</InscricaoMunicipal>" .
            "<SerieNFTS>" . General::getKey($params, NftsEnum::NFTS_SERIES) . "</SerieNFTS>" .
            "<NumeroDocumento>" . General::getKey($params, NftsEnum::DOCUMENT_NUMBER) . "</NumeroDocumento>" .
            "</ChaveDocumento>" .
            "<DataPrestacao>" . General::onlyNumbers(General::getKey($params, NftsEnum::DELIVERY_DATE)) . "</DataPrestacao>" .
            "<StatusNFTS>" . General::getKey($params, NftsEnum::STATUS) . "</StatusNFTS>" .
            "<TributacaoNFTS>" . General::getKey($params, NftsEnum::NFTS_TAX) . "</TributacaoNFTS>" .
            "<ValorServicos>" . General::getKey($params, NftsEnum::SERVICE_VALUE) . "</ValorServicos>" .
            "<ValorDeducoes>" . General::getKey($params, NftsEnum::DEDUCTIONS_VALUE) . "</ValorDeducoes>" .
            "<CodigoServico>" . General::getKey($params, NftsEnum::SERVICE_CODE) . "</CodigoServico>" .
            "<CodigoSubItem>" . General::getKey($params, NftsEnum::SUB_ITEM_CODE) . "</CodigoSubItem>" .
            "<AliquotaServicos>" . General::getKey($params, NftsEnum::SERVICE_TAX) . "</AliquotaServicos>" .
            "<ISSRetidoTomador>" . General::getKey($params, NftsEnum::ISS_TAKER) . "</ISSRetidoTomador>" .
            "<ISSRetidoIntermediario>" . General::getKey($params, NftsEnum::ISS_INTERMEDIARY) . "</ISSRetidoIntermediario>" .
            "<Prestador>" .
            "<CPFCNPJ><CNPJ>" . ((int)General::getKey($params, NftsEnum::CNPJ_PROVIDER)) . "</CNPJ></CPFCNPJ>" .
            "<InscricaoMunicipal>" . General::getKey($params, SimpleFieldsEnum::IM_PROVIDER) . "</InscricaoMunicipal>" .
            "<RazaoSocialPrestador>" . General::getKey($params, SimpleFieldsEnum::CORPORATE_NAME_PROVIDER) . "</RazaoSocialPrestador>" .
            "<Endereco>" .
            "<TipoLogradouro>" . General::getKey($params, SimpleFieldsEnum::TYPE_ADDRESS) . "</TipoLogradouro>" .
            "<Logradouro>" . General::getKey($params, SimpleFieldsEnum::ADDRESS) . "</Logradouro>" .
            "<NumeroEndereco>" . General::getKey($params, SimpleFieldsEnum::ADDRESS_NUMBER) . "</NumeroEndereco>" .
            "<ComplementoEndereco>" . General::getKey($params, SimpleFieldsEnum::ADDRESS_COMPLEMENT) . "</ComplementoEndereco>" .
            "<Bairro>" . General::getKey($params, SimpleFieldsEnum::NEIGHBORHOOD) . "</Bairro>" .
            "<Cidade>" . General::getKey($params, SimpleFieldsEnum::CITY) . "</Cidade>" .
            "<UF>" . General::getKey($params, SimpleFieldsEnum::STATE) . "</UF>" .
            "<CEP>" . General::getKey($params, SimpleFieldsEnum::ZIP_CODE) . "</CEP>" .
            "</Endereco>" . "<Email>" . General::getKey($params, SimpleFieldsEnum::EMAIL) . "</Email>" .
            "</Prestador>" .
            "<RegimeTributacao>" . General::getKey($params, NftsEnum::TAXATION_REGIME) . "</RegimeTributacao>" .
            "<DataPagamento>" . General::onlyNumbers(General::getKey($params, NftsEnum::PAYMENT_DATE)) . "</DataPagamento>" . "<Discriminacao>" . General::getKey($params, NftsEnum::DISCRIMINATION) . "</Discriminacao>" .
            "<TipoNFTS>" . General::getKey($params, NftsEnum::TYPE) . "</TipoNFTS>" .
            "<Tomador>" .
            "<CPFCNPJ><CPF>" . (int)(General::getKey($params, SimpleFieldsEnum::CNPJ_TAKER)) . "</CPF></CPFCNPJ>" .
            "<RazaoSocial>" . General::getKey($params, SimpleFieldsEnum::CORPORATE_NAME_TAKER) . "</RazaoSocial>" .
            "</Tomador>" .
            "</tpNFTS>";
        return utf8_encode($signature);
    }
}