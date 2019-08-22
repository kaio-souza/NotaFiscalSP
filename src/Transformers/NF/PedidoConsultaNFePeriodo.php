<?php
namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\DetailValidator;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoConsultaNFePeriodo extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params)
    {
        $extra = [
            HeaderEnum::CPFCNPJ_SENDER => true,
        ];
        if(
            !General::getKey($params, SimpleFieldsEnum::CNPJ) &&
            !General::getKey($params, SimpleFieldsEnum::CPF) &&
            !General::getKey($params, HeaderEnum::IM)
        ){
            $extra[SimpleFieldsEnum::CNPJ] = $information->getCnpj();
            $extra[HeaderEnum::IM] = $information->getIm();
        }
        $request = $this->makeHeader($information, array_merge($extra, $params));

        return ArrayToXml::convert($request , [
            'rootElementName' => 'p1:PedidoConsultaNFePeriodo',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');

    }

}