<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Requests\HeaderConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\DetailValidator;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoInformacoesLote extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $im = null)
    {
        $im = !empty($im) ? $im : $information->getIm();

        $request = $this->makeHeader($information, [
            HeaderConstants::CPFCNPJ_SENDER => true,
            SimpleFieldsConstants::IM_PROVIDER =>  $im,

        ]);

        return ArrayToXml::convert($request , [
            'rootElementName' => 'p1:PedidoInformacoesLote',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            ],
        ], true, 'UTF-8');

    }

}