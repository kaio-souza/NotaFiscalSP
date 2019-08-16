<?php

namespace NotaFiscalSP\Transformers;

use NotaFiscalSP\Constants\Requests\ComplexFieldsConstants;
use NotaFiscalSP\Constants\Requests\DetailConstants;
use NotaFiscalSP\Constants\Requests\HeaderConstants;
use NotaFiscalSP\Constants\Requests\RpsConstants;
use NotaFiscalSP\Constants\Requests\SimpleFieldsConstants;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Helpers\General;

abstract class NfAbstract
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

        foreach (HeaderConstants::simpleTypes() as $field) {
            if (isset($extraInformations[$field]))
                $header[$field] = $extraInformations[$field];
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

    public function makeDetail(BaseInformation $information, $extraInformations)
    {
        $detail = [];

        foreach (DetailConstants::signedTypes() as $field) {
            if (isset($extraInformations[$field]))
                $detail[$field] = Certificate::signatureRpsItem($information, $extraInformations[$field]);
        }

        if (isset($extraInformations[ComplexFieldsConstants::RPS_KEY]))
            array_merge($detail, $this->makeRpsKey($extraInformations));

        if (isset($extraInformations[ComplexFieldsConstants::NFE_KEY]))
            array_merge($detail, $this->makeNfeKey($extraInformations));

        return [
            DetailConstants::DETAIL => $detail,
        ];
    }

    private function makeNfeKey($extraInformations){
        return [
            ComplexFieldsConstants::NFE_KEY => [
                SimpleFieldsConstants::IM_PROVIDER => General::param($extraInformations, SimpleFieldsConstants::IM_PROVIDER),
                SimpleFieldsConstants::NFE_NUMBER => General::param($extraInformations, SimpleFieldsConstants::NFE_NUMBER),
                SimpleFieldsConstants::VERIFICATION_CODE => General::param($extraInformations, SimpleFieldsConstants::VERIFICATION_CODE),
            ]
        ];
    }

    private function makeRpsKey($extraInformations)
    {
        return [
            ComplexFieldsConstants::RPS_KEY => [
                SimpleFieldsConstants::IM_PROVIDER => General::param($extraInformations, SimpleFieldsConstants::IM_PROVIDER),
                SimpleFieldsConstants::RPS_SERIES => General::param($extraInformations, SimpleFieldsConstants::RPS_SERIES),
                SimpleFieldsConstants::RPS_NUMBER => General::param($extraInformations, SimpleFieldsConstants::RPS_NUMBER),
            ]
        ];
    }

    public function makeRPS(BaseInformation $information, $extraInformations)
    {
        $rps = [
            DetailConstants::SIGN => Certificate::signatureRpsItem($information, General::param($extraInformations, DetailConstants::SIGN))
        ];

        if (isset($extraInformations[ComplexFieldsConstants::RPS_KEY]))
            array_merge($rps, $this->makeRpsKey($extraInformations));

        foreach (RpsConstants::simpleTypes() as $field) {
            if (isset($extraInformations[$field]))
                $rps[$field] = $extraInformations[$field];
        }

        $rps[RpsConstants::CPFCNPJ_TAKER] = $this->makeCPFCNPJTaker($extraInformations);
        $rps[ComplexFieldsConstants::ADDRESS] = $this->makeAddress($extraInformations);

                return [
                    RpsConstants::RPS => $rps,
                ];
    }
    private function makeCPFCNPJTaker($extraInformations){
        if (isset($extraInformations[SimpleFieldsConstants::CPF]))
            return [SimpleFieldsConstants::CPF => $extraInformations[SimpleFieldsConstants::CPF]];

        if (isset($extraInformations[SimpleFieldsConstants::CNPJ]))
            return [SimpleFieldsConstants::CNPJ => $extraInformations[SimpleFieldsConstants::CNPJ]];

        return [SimpleFieldsConstants::CNPJ => null];
    }

    private function makeAddress($extraInformations){
        $address = [];
        foreach (SimpleFieldsConstants::addressFields() as $field) {
            if (isset($extraInformations[$field]))
                $address[$field] = $extraInformations[$field];
        }
        return ;
    }
}