<?php

namespace NotaFiscalSP\Builders;

use NotaFiscalSP\Constants\Requests\ComplexFieldsEnum;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\NftsEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\InputTransformer;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\Certificate;
use NotaFiscalSP\Helpers\General;

abstract class NftsAbstract implements InputTransformer
{
    public function makeHeader(BaseInformation $information, $extraInformations)
    {

        $header = [
            '_attributes' => [
                HeaderEnum::VERSION => 1
            ],
        ];

        if (isset($extraInformations[HeaderEnum::SENDER]))
            $header[HeaderEnum::SENDER][HeaderEnum::CPFCNPJ] = $this->getDocument($information);


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

    public function getDocument($information)
    {
        if (!empty($information->getCnpj())) {
            return [SimpleFieldsEnum::CNPJ => $information->getCnpj()];
        } else {
            return [SimpleFieldsEnum::CPF => $information->getCpf()];
        }
    }

    public function makeDetailEmission(BaseInformation $information, $extraInformations)
    {
        $detail = [];

        $cpfCnpj = (General::getKey($extraInformations, SimpleFieldsEnum::CPF) || General::getKey($extraInformations, SimpleFieldsEnum::CNPJ))
            ? $this->makeCpfCnpj($extraInformations)
            : $this->getDocument($information);

        $detail[HeaderEnum::CPFCNPJ_PROVIDER] = $cpfCnpj;

        return [
            DetailEnum::DETAIL_EMISSION => $detail,
        ];
    }

    public function makeCpfCnpj($informations)
    {
        $cnpj = General::getKey($informations, SimpleFieldsEnum::CNPJ);
        $cpf = General::getKey($informations, SimpleFieldsEnum::CPF);

        if ($cnpj)
            return [SimpleFieldsEnum::CNPJ => $cnpj];

        if ($cpf)
            return [SimpleFieldsEnum::CNPJ => $cnpj];

        return null;
    }

    public function makeDetail(BaseInformation $information, $documents, $sign = false)
    {
        $detais = [];

        foreach ($documents as $document) {
            $detail = [];
            // Assinatura usada em detalhes de cancelamento

            if (isset($document[SimpleFieldsEnum::NFTS_NUMBER]))
                $detail = array_merge($detail, $this->makeNftsKey($document));

            if ($sign)
                $detail[DetailEnum::CANCELLATION_SIGN] = Certificate::signItem($information,
                    Certificate::nftsCancellationSignatureString($detail)
                );

            $details[] = $detail;
        }

        return [
            DetailEnum::DETAIL_NFTS => $details,
        ];
    }

    private function makeNftsKey($extraInformations)
    {
        $params = [
            DetailEnum::IM => General::getPath($extraInformations, SimpleFieldsEnum::IM_PROVIDER),
            SimpleFieldsEnum::NFTS_NUMBER => General::getPath($extraInformations, SimpleFieldsEnum::NFTS_NUMBER),
        ];

        $verificationCode = General::getPath($extraInformations, SimpleFieldsEnum::VERIFICATION_CODE);

        if ($verificationCode) {
            $params[SimpleFieldsEnum::VERIFICATION_CODE] = $verificationCode;
        }

        return [
            ComplexFieldsEnum::NFTS_KEY => $params
        ];
    }

    public function makeNFTS(BaseInformation $information, $nftsList)
    {
        $nftsItens = [];
        foreach ($nftsList as $extraInformations) {
            $nfts = [
                NftsEnum::DOCUMENT_TYPE => General::getKey($extraInformations, NftsEnum::DOCUMENT_TYPE)
            ];

            $nfts[NftsEnum::DOCUMENT_KEY] = $this->makeDocumentKeyParams($extraInformations);

            foreach (NftsEnum::simpleTypes() as $field) {
                if (isset($extraInformations[$field]))
                    $nfts[$field] = $extraInformations[$field];
            }
            // Taker
            $nfts[NftsEnum::PROVIDER] = $this->makeProvider($extraInformations);

            foreach (NftsEnum::otherSimpleTypes() as $field) {
                if (isset($extraInformations[$field]))
                    $nfts[$field] = $extraInformations[$field];
            }

            foreach (RpsEnum::takerInformations() as $field) {
                if (isset($extraInformations[$field]))
                    $nfts[$field] = $extraInformations[$field];
            }
//            $nfts[ComplexFieldsEnum::ADDRESS] = $this->makeAddress($extraInformations);

            if (isset($extraInformations[RpsEnum::EMAIL_TAKER]))
                $nfts[RpsEnum::EMAIL_TAKER] = $extraInformations[RpsEnum::EMAIL_TAKER];

            if (isset($extraInformations[RpsEnum::DISCRIMINATION]))
                $nfts[RpsEnum::DISCRIMINATION] = $extraInformations[RpsEnum::DISCRIMINATION];

            $nfts[DetailEnum::SIGN] = Certificate::signItem($information, Certificate::nftsSignatureString($nfts));

            $nftsItens[] = $nfts;
        }
        return [
            NftsEnum::NFTS => $nftsItens,
        ];
    }


    public function makeDocumentKeyParams($extraInformation)
    {
        $params = [];

        if (General::getKey($extraInformation, DetailEnum::IM))
            $params[DetailEnum::IM] = General::getKey($extraInformation, DetailEnum::IM);

        if (General::getKey($extraInformation, NftsEnum::NFTS_SERIES))
            $params[NftsEnum::NFTS_SERIES] = General::getKey($extraInformation, NftsEnum::NFTS_SERIES);

        if (General::getKey($extraInformation, NftsEnum::DOCUMENT_NUMBER))
            $params[NftsEnum::DOCUMENT_NUMBER] = General::getKey($extraInformation, NftsEnum::DOCUMENT_NUMBER);

        return $params;
    }

    public function makeProvider($extraInformations)
    {
        $document = General::getKey($extraInformations, NftsEnum::CNPJ_PROVIDER)
            ? [NftsEnum::CNPJ_PROVIDER => General::getKey($extraInformations, NftsEnum::CNPJ_PROVIDER)]
            : [NftsEnum::CPF_PROVIDER => General::getKey($extraInformations, NftsEnum::CPF_PROVIDER)];

        return [
            HeaderEnum::CPFCNPJ => $document,
            ComplexFieldsEnum::ADDRESS => $this->makeAddress($extraInformations)
        ];
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