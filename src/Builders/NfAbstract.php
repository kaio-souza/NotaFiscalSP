<?php

namespace NotaFiscalSP\Builders;

use NotaFiscalSP\Constants\Requests\ComplexFieldsEnum;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Helpers\General;

abstract class NfAbstract implements InputTransformer
{
    public function makeHeader(BaseInformation $information, $extraInformations)
    {
        $header = [
            '_attributes' => [
                HeaderEnum::VERSION => 1
            ],
        ];

        if (isset($extraInformations[HeaderEnum::CPFCNPJ_SENDER]))
            $header[HeaderEnum::CPFCNPJ_SENDER] = [SimpleFieldsEnum::CNPJ => $information->getCnpj()];

        if (isset($extraInformations[SimpleFieldsEnum::CPF]))
            $header[HeaderEnum::CPFCNPJ] = [SimpleFieldsEnum::CPF => $extraInformations[SimpleFieldsEnum::CPF]];

        if (General::getKey($extraInformations, SimpleFieldsEnum::CNPJ))
            $header[HeaderEnum::CPFCNPJ] = [SimpleFieldsEnum::CNPJ => $extraInformations[SimpleFieldsEnum::CNPJ]];

        foreach (HeaderEnum::simpleTypes() as $field) {
            if (isset($extraInformations[$field]))
                $header[$field] = $extraInformations[$field];
        }

        if (isset($header[HeaderEnum::START_DATE]) && !isset($header[HeaderEnum::END_DATE])) {
            $header[HeaderEnum::END_DATE] = $header[HeaderEnum::START_DATE];
        }

        return [
            HeaderEnum::HEADER => $header
        ];
    }

    public function makeTaxPayerInformation($cnpj)
    {
        return [
            ComplexFieldsEnum::CNPJ_TAX_PAYER => [
                SimpleFieldsEnum::CNPJ => $cnpj
            ]
        ];
    }

    public function makeDetail(BaseInformation $information, $documents)
    {
        $detais = [];

        foreach ($documents as $document) {
            $detail = [];
            // Assinatura usada em detalhes de cancelamento

            if (isset($document[SimpleFieldsEnum::RPS_NUMBER]))
                $detail = array_merge($detail, $this->makeRpsKey($document));


            if (isset($document[SimpleFieldsEnum::NFE_NUMBER]))
                $detail = array_merge($detail, $this->makeNfeKey($document));

            foreach (DetailEnum::signedTypes() as $field) {
                if (isset($document[$field]))
                    $detail[$field] = Certificate::signItem($information, $document[$field]);
            }

            $details[] = $detail;
        }

        return [
            DetailEnum::DETAIL => $details,
        ];
    }

    private function makeRpsKey($extraInformations)
    {
        return [
            ComplexFieldsEnum::RPS_KEY => [
                SimpleFieldsEnum::IM_PROVIDER => General::getPath($extraInformations, SimpleFieldsEnum::IM_PROVIDER),
                SimpleFieldsEnum::RPS_SERIES => General::getPath($extraInformations, SimpleFieldsEnum::RPS_SERIES),
                SimpleFieldsEnum::RPS_NUMBER => General::getPath($extraInformations, SimpleFieldsEnum::RPS_NUMBER),
            ]
        ];
    }

    private function makeNfeKey($extraInformations)
    {

        $params = [
            SimpleFieldsEnum::IM_PROVIDER => General::getPath($extraInformations, SimpleFieldsEnum::IM_PROVIDER),
            SimpleFieldsEnum::NFE_NUMBER => General::getPath($extraInformations, SimpleFieldsEnum::NFE_NUMBER),
        ];


        $verificationCode = General::getPath($extraInformations, SimpleFieldsEnum::VERIFICATION_CODE);

        if ($verificationCode) {
            $params[SimpleFieldsEnum::VERIFICATION_CODE] = $verificationCode;
        }

        return [
            ComplexFieldsEnum::NFE_KEY => $params
        ];
    }

    public function makeRPS(BaseInformation $information, $rpsList)
    {
        $rpsItens = [];
        foreach ($rpsList as $extraInformations) {
            $rps = [
                DetailEnum::SIGN => Certificate::signItem($information, General::getPath($extraInformations, DetailEnum::SIGN))
            ];

            $rps = array_merge($rps, $this->makeRpsKey($extraInformations));

            foreach (RpsEnum::simpleTypes() as $field) {
                if (isset($extraInformations[$field]))
                    $rps[$field] = $extraInformations[$field];
            }
            // Taker
            $rps[RpsEnum::CPFCNPJ_TAKER] = $this->makeCPFCNPJTaker($extraInformations);

            foreach (RpsEnum::takerInformations() as $field) {
                if (isset($extraInformations[$field]))
                    $rps[$field] = $extraInformations[$field];
            }
            $rps[ComplexFieldsEnum::ADDRESS] = $this->makeAddress($extraInformations);

            if (isset($extraInformations[RpsEnum::EMAIL_TAKER]))
                $rps[RpsEnum::EMAIL_TAKER] = $extraInformations[RpsEnum::EMAIL_TAKER];

            if (isset($extraInformations[RpsEnum::DISCRIMINATION]))
                $rps[RpsEnum::DISCRIMINATION] = $extraInformations[RpsEnum::DISCRIMINATION];

            $rpsItens[] = $rps;
        }
        return [
            RpsEnum::RPS => $rpsItens,
        ];
    }

    private function makeCPFCNPJTaker($extraInformations)
    {
        if (isset($extraInformations[SimpleFieldsEnum::CPF]))
            return [SimpleFieldsEnum::CPF => $extraInformations[SimpleFieldsEnum::CPF]];

        if (isset($extraInformations[SimpleFieldsEnum::CNPJ]))
            return [SimpleFieldsEnum::CNPJ => $extraInformations[SimpleFieldsEnum::CNPJ]];

        return [SimpleFieldsEnum::CNPJ => null];
    }

    private function makeAddress($extraInformations)
    {
        $address = [];
        foreach (SimpleFieldsEnum::addressFields() as $field) {
            if (isset($extraInformations[$field]))
                $address[$field] = $extraInformations[$field];
        }
        return $address;
    }
}