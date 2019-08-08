<?php
namespace NotaFiscalSP\Helpers;

use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;
use Greenter\XMLSecLibs\Sunat\SignedXml;

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

            return $pem ;
    }

    /**
     * @param $pem
     * @param $xml
     * @return string
     */
    public static function signXmlWithCertificate($pem, $xml){
        // Create Signed XML
        $signer = new SignedXml();

        // Sign XML
        $signer->setCertificate($pem);
        $xmlSigned = $signer->signXml($xml);

        // Return XML File Signed
        return $xmlSigned;
    }

}