<?php

namespace NotaFiscalSP\Entities\Requests\NFTS;

use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Contracts\UserRequest;
use NotaFiscalSP\Helpers\General;

class Document implements UserRequest
{
    public $cpf;
    public $cnpj;

    public function toArray()
    {
        return [
            SimpleFieldsEnum::CPF => $this->getCpf(),
            SimpleFieldsEnum::CNPJ => $this->getCnpj()
        ];
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = General::onlyNumbers($cpf);
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = General::onlyNumbers(cnpj);
    }
}