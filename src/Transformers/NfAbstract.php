<?php
namespace NotaFiscalSP\Transformers;

use NotaFiscalSP\Entities\BaseInformation;

abstract class NfAbstract{
    public function makeHeader(BaseInformation $information, $extraInformations){
        $header = [
                '_attributes' => [
                    'Versao' => 1
                ],
        ];

        if(isset($extraInformations['CPFCNPJRemetente']))
            $header['CPFCNPJRemetente'] = [ 'CNPJ' => $information->getCnpj()];
            $optionalFields = ['NumeroLote', 'transacao', 'Inscricao', 'dtInicio', 'dtFim', 'NumeroPagina', 'QtdRPS', 'ValorTotalServicos', 'ValorTotalDeducoes', 'InscricaoPrestador'];
            foreach ($optionalFields as $field) {
                if(isset($extraInformations[$field]))
                    $header[$field] = $extraInformations[$field];
            }
            return  ['Cabecalho' =>  $header];
    }

    public function makeDetail(){

    }

    public function makeRPS(){

    }
}