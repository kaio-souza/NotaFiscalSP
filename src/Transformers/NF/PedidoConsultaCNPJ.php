<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Transformers\NfAbstract;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoConsultaCNPJ extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params = null){

       $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true
       ]);
       $taxPayer = $this->makeTaxPayerInformation($information->getCnpj());
       $request = array_merge($header,$taxPayer);

        return ArrayToXml::convert($request , [
            'rootElementName' => 'p1:PedidoConsultaCNPJ',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }
}