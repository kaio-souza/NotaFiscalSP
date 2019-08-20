<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Requests\HeaderConstants;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\RpsData;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\DetailValidator;
use Spatie\ArrayToXml\ArrayToXml;

class PedidoEnvioRPS extends NfAbstract
{

    public  function makeXmlRequest(BaseInformation $information, $rps){
        $documents = DetailValidator::queryDetail($information, $rps);
        $header = $this->makeHeader($information, [
            HeaderConstants::CPFCNPJ_SENDER => true
        ]);
        $allRps = $this->makeRPS($information,$documents);

        $request = array_merge($header,$allRps);

        return ArrayToXml::convert($request, [
            'rootElementName' => 'PedidoEnvioRPS',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
            ],
        ], true, 'UTF-8');
    }

}