<?php

namespace NotaFiscalSP\Entities\Requests;

use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\HeaderEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;

class NftsSearch implements UserRequest
{

    public $transacao;
    public $inscricaoMunicipal;
    public $numeroNFTS;

    public function toArray()
    {
        return [
            HeaderEnum::TRANSACTION => $this->transacao,
            DetailEnum::IM => $this->inscricaoMunicipal,
            SimpleFieldsEnum::NFTS_NUMBER => $this->numeroNFTS
        ];
    }
}