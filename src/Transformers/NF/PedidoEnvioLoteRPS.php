<?php

namespace NotaFiscalSP\Transformers\NF;

use NotaFiscalSP\Constants\Methods\NfMethods;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\NF\Lot;
use NotaFiscalSP\Helpers\General;
use NotaFiscalSP\Helpers\Xml;
use NotaFiscalSP\Transformers\NfAbstract;
use NotaFiscalSP\Validators\RpsValidator;

class PedidoEnvioLoteRPS extends NfAbstract
{

    public function makeXmlRequest(BaseInformation $information, $lot)
    {
        if ($lot instanceof Lot)
            $lot = $lot->toArray();

        $documents = RpsValidator::validateRps($information, General::getKey($lot, RpsEnum::RPS));
        $header = $this->makeHeader($information, [
            HeaderEnum::CPFCNPJ_SENDER => true,
            HeaderEnum::TRANSACTION => General::getKey($lot, HeaderEnum::TRANSACTION),
            HeaderEnum::START_DATE => General::getKey($lot, HeaderEnum::START_DATE),
            HeaderEnum::END_DATE => General::getKey($lot, HeaderEnum::END_DATE),
            HeaderEnum::RPS_COUNT => General::getKey($lot, HeaderEnum::RPS_COUNT),
            HeaderEnum::SERVICES_TOTAL => General::getKey($lot, HeaderEnum::SERVICES_TOTAL),
            HeaderEnum::DEDUCTION_TOTAL => General::getKey($lot, HeaderEnum::DEDUCTION_TOTAL),
        ]);
        $allRps = $this->makeRPS($information, $documents);

        $request = array_merge($header, $allRps);

        return Xml::makeRequestXML(NfMethods::ENVIO_LOTE, $request);
    }
}