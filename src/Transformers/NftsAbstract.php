<?php

namespace NotaFiscalSP\Transformers;

use NotaFiscalSP\Constants\Requests\ComplexFieldsEnum;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
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
            $header[HeaderEnum::SENDER][HeaderEnum::CPFCNPJ] = [SimpleFieldsEnum::CNPJ => $information->getCnpj()];


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

    public function makeDetailEmission(BaseInformation $information, $extraInformations)
    {

        $detail = [];

        $cpfCnpj = (General::getKey($extraInformations, SimpleFieldsEnum::CPF) || General::getKey($extraInformations, SimpleFieldsEnum::CNPJ))
            ? $this->makeCpfCnpj($extraInformations)
            : [SimpleFieldsEnum::CNPJ => $information->getCnpj()];

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

    public function makeDetail(BaseInformation $information, $documents)
    {
        $detais = [];

        foreach ($documents as $document) {
            $detail = [];
            // Assinatura usada em detalhes de cancelamento


            if (isset($document[SimpleFieldsEnum::NFTS_NUMBER]))
                $detail = array_merge($detail, $this->makeNftsKey($document));

            foreach (DetailEnum::signedTypes() as $field) {
                if (isset($document[$field]))
                    $detail[$field] = Certificate::signatureRpsItem($information, $document[$field]);
            }

            $details[] = $detail;
        }

        return [
            DetailEnum::DETAIL_NFTS => $details,
        ];
    }

    public function makeNFTS(BaseInformation $information, $nftsList)
    {
        $nftsItens = [];
        foreach ($nftsList as $extraInformations){
            $nfts = [
                DetailEnum::SIGN => Certificate::signatureRpsItem($information, General::getPath($extraInformations, DetailEnum::SIGN))
            ];

            $nfts = array_merge($nfts, $this->makeRpsKey($extraInformations));

            foreach (RpsEnum::simpleTypes() as $field) {
                if (isset($extraInformations[$field]))
                    $nfts[$field] = $extraInformations[$field];
            }
            // Taker
            $nfts[RpsEnum::CPFCNPJ_TAKER] = $this->makeCPFCNPJTaker($extraInformations);

            foreach (RpsEnum::takerInformations() as $field) {
                if (isset($extraInformations[$field]))
                    $nfts[$field] = $extraInformations[$field];
            }
            $nfts[ComplexFieldsEnum::ADDRESS] = $this->makeAddress($extraInformations);

            if (isset($extraInformations[RpsEnum::EMAIL_TAKER]))
                $nfts[RpsEnum::EMAIL_TAKER] = $extraInformations[RpsEnum::EMAIL_TAKER];

            if (isset($extraInformations[RpsEnum::DISCRIMINATION]))
                $nfts[RpsEnum::DISCRIMINATION] = $extraInformations[RpsEnum::DISCRIMINATION];

            $nftsItens[] = $nfts;
        }
        return [
            RpsEnum::RPS => $nftsItens,
        ];
    }

    public function makeDocumentKey($extraInformation){

    }

}