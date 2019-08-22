<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\DetailValidator;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoConsultaLote extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $lotNumber)
    {

        $request = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true,
            HeaderEnum::LOT_NUMBER =>  $lotNumber
        ]);

        return ArrayToXml::convert($request , [
            'rootElementName' => 'p1:PedidoConsultaLote',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');

    }

}