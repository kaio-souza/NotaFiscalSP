<?php
namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Exceptions\RequiredDataMissing;

/**
 * Class BaseInformationValidator
 * @package NotaFiscalSP\Validators
 */
class BaseInformationValidator{
    /**
     * @param $input
     * @throws RequiredDataMissing
     */
    public static function basic($input){
        // CNPJ é uma identificação obrigatória para criar a RPS da Nota
        if(!isset($input[Params::CNPJ]))
            throw new RequiredDataMissing('cnpj');

        // Para Realizar o acesso a API e Assinar é obrigatório o Certifiado digital da empresa (.PFX ou .PEM)
        if(!isset($input[Params::CERTIFICATE_PATH]))
            throw new RequiredDataMissing('certificatePath (Caminho para o Certificado Digital)');

        $isPfx = strpos($input[Params::CERTIFICATE_PATH], '.pfx');
        $isPem = strpos($input[Params::CERTIFICATE_PATH], '.pem');

        // Certificado necessita ser .PEM, porém é aceito o .PFX e posteriormente convertido
        if(!$isPfx && !$isPem)
            throw new RequiredDataMissing('certificatePath (Certificado Digital deve ser .pfx ou .pem)');

        // Caso seja enviado um certificado .PFX é necessário a senha para criar o .PEM
        if(!isset($input[Params::CERTIFICATE_PASS])){
           throw new RequiredDataMissing('certificatePass (Senha do Certificado Digital é obrigatória )');
        }
    }
}