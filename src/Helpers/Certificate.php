<?php

namespace NotaFiscalSP\Helpers;

use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;
use Greenter\XMLSecLibs\Sunat\SignedXml;
use NotaFiscalSP\Constants\FieldData\BooleanFields;
use NotaFiscalSP\Constants\Requests\RpsConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
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
     * @throws \Exception
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
        $document = General::getKey($params, SimpleFieldsConstants::CNPJ) ? General::getKey($params, SimpleFieldsConstants::CNPJ) : General::getKey($params, SimpleFieldsConstants::CPF);
        //Required Fields
        $string =
            sprintf('%08s', General::getKey($params, SimpleFieldsConstants::IM_PROVIDER)) .
            sprintf('%-5s', General::getKey($params, SimpleFieldsConstants::RPS_SERIES)) . // 5 chars
            sprintf('%012s', General::getKey($params, SimpleFieldsConstants::RPS_NUMBER)) .
            str_replace('-','',General::getKey($params, RpsConstants::EMISSION_DATE)) .
            General::getKey($params, RpsConstants::RPS_TAX) .
            General::getKey($params, RpsConstants::RPS_STATUS) .
            ($params[RpsConstants::ISS_RETENTION] == 'false' ? BooleanFields::FALSE : BooleanFields::TRUE ).
            sprintf('%015s', str_replace(array('.', ','), '', number_format(General::getKey($params, RpsConstants::SERVICE_VALUE), 2))) .
            sprintf('%015s', str_replace(array('.', ','), '', number_format(General::getKey($params, RpsConstants::DEDUCTION_VALUE), 2))) .
            sprintf('%05s', General::getKey($params, RpsConstants::SERVICE_CODE)) .
            ((General::getKey($params, SimpleFieldsConstants::CPF)) ? 1 : 2) .
            General::getKey($params, SimpleFieldsConstants::CPF) .
            sprintf('%014s', $document);

        // AVAILABLE ON RELEASE 2

        return $string;
    }

    public static function cancelSignatureString($params)
    {
        return sprintf('%08s', General::getKey($params, SimpleFieldsConstants::IM_PROVIDER)) .
            sprintf('%012s', General::getKey($params, SimpleFieldsConstants::NFE_NUMBER));
    }
}