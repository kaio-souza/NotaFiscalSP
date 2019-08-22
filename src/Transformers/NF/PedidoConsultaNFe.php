<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\RpsData;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\DetailValidator;
use Spatie\ArrayToXml\ArrayToXml;

class PedidoConsultaNFe extends NfAbstract
{

    public function makeXmlRequest(BaseInformation $information, $documents)
    {
        $documents = DetailValidator::queryDetail($information, $documents);
        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true
        ]);
        $detail = $this->makeDetail($information,$documents);

        $request = array_merge($header,$detail);

        return ArrayToXml::convert($request , [
            'rootElementName' => 'p1:PedidoConsultaNFe',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');

    }

}