<?php
namespace NotaFiscalSP\Transformers\AsyncNF;

use NotaFiscalSP\Constants\Requests\HeaderConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Transformers\NfAbstract;
use Spatie\ArrayToXml\ArrayToXml;

class  PedidoEmissaoGuiaAsync extends NfAbstract
{
    public function makeXmlRequest(BaseInformation $information, $params = null)
    {
        $request = [];
        $request[HeaderConstants::CPFCNPJ_SENDER] = [SimpleFieldsConstants::CNPJ => $information->getCnpj()];
        $request[SimpleFieldsConstants::IM_PROVIDER] = $information->getIm();
        $request[SimpleFieldsConstants::EMISSION_TYPE] = General::getKey($params, SimpleFieldsConstants::EMISSION_TYPE);
        $request[SimpleFieldsConstants::INCIDENCE] = General::getKey($params, SimpleFieldsConstants::INCIDENCE);
        $request[SimpleFieldsConstants::PAYMENT_DATE] = General::getKey($params, SimpleFieldsConstants::PAYMENT_DATE);

        return ArrayToXml::convert($request, [
            'rootElementName' => 'p1:PedidoEmissaoGuiaAsync',
            '_attributes' => [
                'xmlns:p1' => 'http://www.prefeitura.sp.gov.br/nfe',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance'
            ],
        ], true, 'UTF-8');
    }
}