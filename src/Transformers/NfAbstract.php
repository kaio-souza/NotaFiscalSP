<?php

namespace NotaFiscalSP\Transformers;

use NotaFiscalSP\Constants\Requests\ComplexFieldsConstants;
use NotaFiscalSP\Constants\Requests\DetailConstants;
use NotaFiscalSP\Constants\Requests\HeaderConstants;
use NotaFiscalSP\Constants\Requests\RpsConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
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
                HeaderConstants::VERSION => 1
            ],
        ];

        if (isset($extraInformations[HeaderConstants::CPFCNPJ_SENDER]))
            $header[HeaderConstants::CPFCNPJ_SENDER] = [SimpleFieldsConstants::CNPJ => $information->getCnpj()];

        if (isset($extraInformations[SimpleFieldsConstants::CPF]))
            $header[HeaderConstants::CPFCNPJ] = [SimpleFieldsConstants::CPF => $extraInformations[SimpleFieldsConstants::CPF]];

        if (General::getKey($extraInformations, SimpleFieldsConstants::CNPJ))
            $header[HeaderConstants::CPFCNPJ] = [SimpleFieldsConstants::CNPJ => $extraInformations[SimpleFieldsConstants::CNPJ]];

        foreach (HeaderConstants::simpleTypes() as $field) {
            if (isset($extraInformations[$field]))
                $header[$field] = $extraInformations[$field];
        }

        if (isset($header[HeaderConstants::START_DATE]) && !isset($header[HeaderConstants::END_DATE])) {
            $header[HeaderConstants::END_DATE] = $header[HeaderConstants::START_DATE];
        }

        if (isset($header[HeaderConstants::START_DATE]) && !isset($header[HeaderConstants::PAGE_NUMBER])) {
            $header[HeaderConstants::PAGE_NUMBER] = 1;
        }

        return [
            HeaderConstants::HEADER => $header
        ];
    }

    public function makeTaxPayerInformation($cnpj)
    {
        return [
            ComplexFieldsConstants::CNPJ_TAX_PAYER => [
                SimpleFieldsConstants::CNPJ => $cnpj
            ]
        ];
    }

    public function makeDetail(BaseInformation $information, $documents)
    {
        $detais = [];

        foreach ($documents as $document) {
            $detail = [];
            // Assinatura usada em detalhes de cancelamento

            if (isset($document[SimpleFieldsConstants::RPS_NUMBER]))
                $detail = array_merge($detail, $this->makeRpsKey($document));


            if (isset($document[SimpleFieldsConstants::NFE_NUMBER]))
                $detail = array_merge($detail, $this->makeNfeKey($document));

            foreach (DetailConstants::signedTypes() as $field) {
                if (isset($document[$field]))
                    $detail[$field] = Certificate::signatureRpsItem($information, $document[$field]);
            }

            $details[] = $detail;
        }

        return [
            DetailConstants::DETAIL => $details,
        ];
    }

    private function makeNfeKey($extraInformations)
    {

        $params = [
            SimpleFieldsConstants::IM_PROVIDER => General::getPath($extraInformations, SimpleFieldsConstants::IM_PROVIDER),
            SimpleFieldsConstants::NFE_NUMBER => General::getPath($extraInformations, SimpleFieldsConstants::NFE_NUMBER),
        ];


        $verificationCode = General::getPath($extraInformations, SimpleFieldsConstants::VERIFICATION_CODE);

        if ($verificationCode) {
            $params[SimpleFieldsConstants::VERIFICATION_CODE] = $verificationCode;
        }

        return [
            ComplexFieldsConstants::NFE_KEY => $params
        ];
    }


    private function makeRpsKey($extraInformations)
    {
        return [
            ComplexFieldsConstants::RPS_KEY => [
                SimpleFieldsConstants::IM_PROVIDER => General::getPath($extraInformations, SimpleFieldsConstants::IM_PROVIDER),
                SimpleFieldsConstants::RPS_SERIES => General::getPath($extraInformations, SimpleFieldsConstants::RPS_SERIES),
                SimpleFieldsConstants::RPS_NUMBER => General::getPath($extraInformations, SimpleFieldsConstants::RPS_NUMBER),
            ]
        ];
    }

    public function makeRPS(BaseInformation $information, $extraInformations)
    {
        $rps = [
            DetailConstants::SIGN => Certificate::signatureRpsItem($information, General::getPath($extraInformations, DetailConstants::SIGN))
        ];

        $rps = array_merge($rps, $this->makeRpsKey($extraInformations));

        foreach (RpsConstants::simpleTypes() as $field) {
            if (isset($extraInformations[$field]))
                $rps[$field] = $extraInformations[$field];
        }
        // Taker
        $rps[RpsConstants::CPFCNPJ_TAKER] = $this->makeCPFCNPJTaker($extraInformations);

        foreach (RpsConstants::takerInformations() as $field) {
            if (isset($extraInformations[$field]))
                $rps[$field] = $extraInformations[$field];
        }
        $rps[ComplexFieldsConstants::ADDRESS] = $this->makeAddress($extraInformations);

        if (isset($extraInformations[RpsConstants::EMAIL_TAKER]))
            $rps[RpsConstants::EMAIL_TAKER] = $extraInformations[RpsConstants::EMAIL_TAKER];

        if (isset($extraInformations[RpsConstants::DISCRIMINATION]))
            $rps[RpsConstants::DISCRIMINATION] = $extraInformations[RpsConstants::DISCRIMINATION];

        return [
            RpsConstants::RPS => $rps,
        ];
    }

    private function makeCPFCNPJTaker($extraInformations)
    {
        if (isset($extraInformations[SimpleFieldsConstants::CPF]))
            return [SimpleFieldsConstants::CPF => $extraInformations[SimpleFieldsConstants::CPF]];

        if (isset($extraInformations[SimpleFieldsConstants::CNPJ]))
            return [SimpleFieldsConstants::CNPJ => $extraInformations[SimpleFieldsConstants::CNPJ]];

        return [SimpleFieldsConstants::CNPJ => null];
    }

    private function makeAddress($extraInformations)
    {
        $address = [];
        foreach (SimpleFieldsConstants::addressFields() as $field) {
            if (isset($extraInformations[$field]))
                $address[$field] = $extraInformations[$field];
        }
        return $address;
    }
}