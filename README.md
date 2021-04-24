# NFe-NFTS-SP (PHP)
[![Latest Stable Version](https://poser.pugx.org/kaleu62/notafiscalsp/v/stable)](https://packagist.org/packages/kaleu62/notafiscalsp) [![Total Downloads](https://poser.pugx.org/kaleu62/notafiscalsp/downloads)](https://packagist.org/packages/kaleu62/notafiscalsp) [![License](https://poser.pugx.org/kaleu62/notafiscalsp/license)](https://packagist.org/packages/kaleu62/notafiscalsp)


O Projeto se trata de um módulo de integração com o sistema de notas da Prefeitura de São Paulo (Nota do Milhão), possibilitando a automatização de serviços como emissão e consulta de Notas e outros serviços relacionados.

### Extensões Necessárias 
- Soap
- openssl

### Referências úteis
- Na hora de emitir uma nota o campo de Cidade do Tomador é preenchido com o código do IBGE para a mesma, e ele pode ser consultado no site https://cidades.ibge.gov.br/brasil/sp/sao-paulo

## Instanciando a Classe
Para instanciar a classe é necessário informar o CNPJ, o Certificado do Emissor e a senha do mesmo. No caso do caminho do Certificado pode ser utilizado o arquivo '.pfx' ou '.pem'

```php
  // Instanciando a Classe
  $nfSP = new NotaFiscalSP([
      'cnpj' => '00000000000000',
      'certificate' => 'path/to/certificate.pfx',
      'certificatePass' => '000000'
  ]);
```

Ao instanciar a Lib ela faz uma requisiçao para obter a Inscrição Municipal(IM), porém a mesma pode ser passada como parametro.

```php
  // Instanciando a Classe
  $nfSP = new NotaFiscalSP([
      'cnpj' => '00000000000000',
      'certificate' => 'path/to/certificate.pfx',
      'certificatePass' => '000000',
      'im' => '1225'
  ]);
```

# Nota Fiscal (NFs NFe)
## Obtendo Informações Base do CNPJ
Esse método retorna a Inscrição Municipal relacionada ao CNPJ e um booleano indicando se o mesmo pode emitir NFe

```php
// Consulta seu próprio CNPJ para verificar a Inscrição Municipal
$response = $nfSP->cnpjInfo(); 
```

```php
// Consulta um CNPJ para verificar a inscrição municipal e a situação referente a emissão
$response = $nfSP->cnpjInfo('111.222.333-44'); 
```

## Obtendo Informações Basicas do Lote
Retorna apeas informações básicas como horário de envio do lote

```php
$response = $nfSP->informacaoLote();
```

## Consultando Nota Fiscal
Retorna Informaçes detalhadas de uma ou mais Notas ***(Limite 50 Notas por Requisição)***

```php
// Utilize o numero da nota
$response = $nfSP->consultarNf('00056');
```

*Para maiores detalhes sobre a consulta de várias notas simultaneamente veja o Wiki

## Obtendo PDF da Nota
Retorna o Output do PDF de uma nota

```php
// Utilize o numero da nota
$response = $nfSP->arquivoNota('00056');
file_put_contents('teste.pdf', $response);
```

```php
// Caso você já tenha as informações necessarias, ao passar mais parametros evita a request de consulta
// SEQUENCIA DE PARAMETROS: NUMERO DA NOTA, INSCRIÇÃO DO PRESTADOR, CÓDIGO DE VERIFICAÇÃO (todos esses dados são fornecidos ao criar uma nota, ou ao consulta-la no campo *ChaveNFe*)
$response = $nfSP->arquivoNota('00056', '12313212', 'ASDSDSA655');
file_put_contents('teste.pdf', $response);
```


## Consultando Notas Fiscais Recebidas por Periodo
Retorna Notas recebidas em um periodo especifico ***(50 Notas por Pagina)***

```php
$period = new Period();
$period->setDtInicio('2019-08-05');
$period->setDtFim('2019-08-10');
$period->setPagina(2);

$response = $nfSP->notasRecebidas($period);
```
***- Caso não insira a data Final, serão retornados somente registros da data inicial***

***- Caso não seja informado o numero da página o valor padrão é 1***

## Consultando Notas Fiscais Emitidas por Periodo
Retorna Notas emitidas em um periodo especifico ***(50 Notas por Pagina)***

```php
$period = new Period();
$period->setDtInicio('2019-08-05');
$period->setDtFim('2019-08-10');
$period->setPagina(2);

$response = $nfSP->notasEmitidas($period);
```
***- Caso não insira a data Final, serão retornados somente registros da data inicial***

***- Caso não seja informado o numero da página o valor padrão é 1***

## Consultando Lote
Retorna Informações detalhadas de um lote especifico

```php
// Utilize o numero do Lote
$response = $nfSP->consultarLote(356);
```
*Para mais detalhes da utilizaço acesse o Wiki 

## Cancelando Nota Fiscal
Cancela uma ou mais Notas ***(Limite 50 Notas por Requisição)***

```php
$response = $nfSP->cancelarNota('00568');
```

## Emitindo uma Nota
```php
$rps = new Rps();
$rps->setNumeroRps('00000000');
$rps->setTipoRps(RPSType::RECIBO_PROVENIENTE_DE_NOTA_CONJUGADA);
$rps->setValorServicos(30.80);
$rps->setCodigoServico(2881);
$rps->setAliquotaServicos( 0.029);
$rps->setCnpj('10000000000001');
$rps->setRazaoSocialTomador('RAZAO SOCIAL TOMADOR LTDA');
$rps->setTipoLogradouro('R');
$rps->setLogradouro('NOME DA RUA');
$rps->setNumeroEndereco(001);
$rps->setBairro('VILA TESTE');
$rps->setCidade('3550308'); // São Paulo
$rps->setUf('SP');
$rps->setCep('00000000');
$rps->setEmailTomador('teste@teste.com.br');
$rps->setDiscriminacao('Teste Emissão de Notas pela API');

$response =  $nfSP->enviarNota($rps);
```

## Enviando Lote
O Lote envia diversos objetos do tipo RPS em uma unica requisição

```php
$lote = new Lot();
$lote->setRpsList([$rps1, $rps2, $rps3]);
$response =  $nfSP->enviarLote($lote);
```

## Enviando um Lote Async
O Lote ASYNC utiliza um outro Endpoint e pode ser útil caso o sistema de Notas esteja com alguma instabilidade ou em manutenção, é utilizada a mesma request porém é retornado um número de protocolo que pode ser consultado posteriormente
```php
// Enviar Lote Async
$makeProtocol = $nfSP->enviarLoteAsync($lot);

// Consultar se o lote foi emitido
$lotResult = $nfSP->consultarLoteAsync('1223589');
```

# NFTS
## Consultando uma NFTS
```php
    $nfSP->consultarNfts('454565')
```
## Emitindo uma NFTS
```php
// Montando o objeto da NFTS
$nfts = new Nfts();
$nfts->setNumeroDocumento('000000000000');
$nfts->setSerieNFTS('A');
$nfts->setCodigoServico('7099');
$nfts->setValorServicos('150.30');
$nfts->setCnpjPrestador('00000000000100');
$nfts->setDiscriminacao('xxx');
$nfts->setDataPrestacao('2019-09-10');
$nfts->setTipoDocumento('01');
$nfts->setRazaoSocialPrestador('XXXX');
$nfts->setLogradouroPrestador('Avenida x x x');
$nfts->setCidadePrestador('x');
$nfts->setNumeroEnderecoPrestador('250');
$nfts->setBairroPrestador('Vila x');
$nfts->setUfPrestador('SP');
$nfts->setCepPrestador('06000000');

// Emitindo a NFTS
$nfSP->enviarNfts($nfts);
```

## Cancelando uma NFTS
```php
$response = $nfSP->cancelarNfts('00568');
```


# Métodos Básicos do Response
## getResponse
Retorna uma array com as informaçes da resposta da API
```php
  $response->getResponse();
```


## getXmlInput
Retorna o XML enviado para API (REQUEST)
```php
  $response->getXmlInput();
```

## getXmlOutput
Retorna o XML Recebido da API (RESPONSE)
```php
  $response->getXmlOutput();
```

## getSuccess
Verifica o sucesso da operação realizada
```php
  $response->getSuccess();
```

## Classe NfSearch (NotaFiscalSP\Entities\Requests\NF\NfSearch)
É a classe utilizada para referenciar uma Nota Fiscal já Existente, não é necessário preencher todas propriedades, apenas o NumeroNfe é o suficiente.
   
|          **Propriedade**           |          **Método**         |   **Tipo**   |
|:----------------------------------:|:---------------------------:|:------------:|
|         InscricaoPrestador         |   setInscricaoPrestador()   |      int     |
|              NumeroNfe             |        setNumeroNfe()       |      int     |
|          CodigoVerificacao         |    setCodigoVerificacao()   |    string    |
|              NumeroRPS             |        setNumeroRPS()       |      int     |
|              SerieRPS              |        setSerieRPS()        |    string    |


## Classe Period (NotaFiscalSP\Entities\Requests\NF\Period)
Utilizada na realização de consultas por periodo nas notas Emitidas e Recebidas, caso não altere nenhuma das propriedades retorna uma busca com os valores Padrões para data Atual

|         **Propriedade**           |          **Método**           |   **Tipo**   |    ** Observações**    |
|:---------------------------------:|:-----------------------------:|:------------:|:----------------------:|
|                CPF                |            setCpf()           |    string    |                        |
|                CNPJ               |           setCnpj()           |    string    |                        |
|         InscricaoMunicipal        |    setInscricaoMunicipal()    |      int     |                        |
|              DtInicio             |         setDtInicio()         |    string    |   format(YYYY-MM-DD)   |
|               DtFim               |           setDtFim()          |    string    |   format(YYYY-MM-DD)   |
|               Pagina              |          setPagina()          |      int     |                        |
|             Transacao             |         setTransacao()        |    boolean   |                        |

## Classe Rps (NotaFiscalSP\Entities\Requests\NF\Rps)
Objeto utilizado para emissão de novas notas

|         **Propriedade**           |              **Método**              |   **Tipo**   |       ** Observações**       |
|:---------------------------------:|:------------------------------------:|:------------:|:----------------------------:|
|         InscricaoPrestador        |        setInscricaoPrestador()       |      int     |                              |
|              SerieRps             |             setSerieRps()            |    string    |                              |
|             NumeroRps             |            setNumeroRps()            |      int     |                              |
|              TipoRps              |             setTipoRps()             |    string    |                              |
|            DataEmissao            |           setDataEmissao()           |    string    |      format(YYYY-MM-DD)      |
|             StatusRps             |            setStatusRps()            |    string    |                              |
|           TributacaoRps           |          setTributacaoRps()          |    string    |                              |
|           ValorServicos           |          setValorServicos()          |     float    |                              |
|           ValorDeducoes           |          setValorDeducoes()          |      int     |          default: 0          |
|              ValorPIS             |             setValorPIS()            |     float    |                              |
|            ValorCOFINS            |           setValorCOFINS()           |     float    |                              |
|             ValorINSS             |            setValorINSS()            |     float    |                              |
|              ValorIR              |             setValorIR()             |     float    |                              |
|             ValorCSLL             |            setValorCSLL()            |     float    |                              |
|           CodigoServico           |          setCodigoServico()          |      int     |                              |
|          AliquotaServicos         |         setAliquotaServicos()        |     float    |                              |
|             IssRetido             |            setIssRetido()            |    boolean   |        default: false        |
|     InscricaoMunicipalTomador     |    setInscricaoMunicipalTomador()    |      int     |                              |
|      InscricaoEstadualTomador     |     setInscricaoEstadualTomador()    |      int     |                              |
|         RazaoSocialTomador        |        setRazaoSocialTomador()       |    string    |                              |
|            EmailTomador           |           setEmailTomador()          |    string    |                              |
|           CpfCnpjTomador          |          setCpfCnpjTomador()         |    string    |                              |
|           TipoLogradouro          |          setTipoLogradouro()         |    string    |                              |
|             Logradouro            |            setLogradouro()           |    string    |                              |
|           NumeroEndereco          |          setNumeroEndereco()         |      int     |                              |
|        ComplementoEndereco        |       setComplementoEndereco()       |    string    |                              |
|               Bairro              |              setBairro()             |    string    |                              |
|               Cidade              |              setCidade()             |    string    | default: 3550308 (São Paulo) |
|                 UF                |                setUF()               |    string    |                              |
|                Cep                |               setCep()               |    string    |                              |
|                Cpf                |               setCpf()               |    string    |                              |
|                Cnpj               |               setCnpj()              |    string    |                              |
|           Discriminacao           |          setDiscriminacao()          |    string    |                              |
|          cpfIntermediario         |         setcpfIntermediario()        |    string    |                              |
|         cnpjIntermediario         |        setcnpjIntermediario()        |    string    |                              |
|  InscricaoMunicipalIntermediario  | setInscricaoMunicipalIntermediario() |      int     |                              |
|       IssRetidoIntermediario      |      setIssRetidoIntermediario()     |    boolean   |                              |
|         EmailIntermediario        |        setEmailIntermediario()       |    string    |                              |
|        ValorCargaTributaria       |       setValorCargaTributaria()      |     float    |                              |
|     PercentualCargaTributaria     |    setPercentualCargaTributaria()    |     float    |                              |
|        FonteCargaTributaria       |       setFonteCargaTributaria()      |    string    |                              |
|             CodigoCEI             |            setCodigoCEI()            |    string    |                              |
|           MatriculaObra           |          setMatriculaObra()          |    string    |                              |
|         MunicipioPrestacao        |        setMunicipioPrestacao()       |    string    |                              |
|         ValortotalRecebido        |        setValortotalRecebido()       |     float    |                              |
|        NumeroEncapsulamento       |       setNumeroEncapsulamento()      |      int     |                              |
