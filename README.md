# NFe-NFTS-SP (PHP)
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
  $nfSP = new NotaFiscal([
      'cnpj' => '00000000000000',
      'certificate' => 'path/to/certificate.pfx',
      'certificatePass' => '000000'
  ]);
```

## Obtendo Informações Base do CNPJ
Esse método retorna a Inscrição Municipal relacionada ao CNPJ e um booleano indicando se o mesmo pode emitir NFe

```php
$response = $nf->cnpjInformation();
```
## Obtendo Informações Basicas do Lote
Retorna apeas informações básicas como horário de envio do lote

```php
$response = $nf->lotInformation();
```

## Consultando Nota Fiscal
Retorna Informaçes detalhadas de uma ou mais Notas ***(Limite 50 Notas por Requisição)***

```php
$nf = new Nf();
$nf->setNumeroNfe(255);

$response = $nf->getNf($nf);
```

## Consultando Notas Fiscais Recebidas por Periodo
Retorna Notas recebidas em um periodo especifico ***(50 Notas por Pagina)***

```php
$period = new Period();
$period->setDtInicio('2019-08-05');
$period->setDtInicio('2019-08-10');
$period->setPagina(2);

$response = $nf->nfReceived($period);
```
***- Caso não insira a data Final, serão retornados somente registros da data inicial***

***- Caso não seja informado o numero da página o valor padrão é 1***

## Consultando Notas Fiscais Emitidas por Periodo
Retorna Notas emitidas em um periodo especifico ***(50 Notas por Pagina)***

```php
$period = new Period();
$period->setDtInicio('2019-08-05');
$period->setDtInicio('2019-08-10');
$period->setPagina(2);

$response = $nf->nfReceived($period);
```
***- Caso não insira a data Final, serão retornados somente registros da data inicial***

***- Caso não seja informado o numero da página o valor padrão é 1***

## Consultando Lote
Retorna Informações detalhadas de um lote especifico

```php
$response = $nf->getLot(356);
```

## Cancelando Nota Fiscal
Cancela uma ou mais Notas ***(Limite 50 Notas por Requisição)***

```php
$nf = new Nf();
$nf->setNumeroNfe(255);

$response = $nf->cancelNf($nf);
```

## emmitNf 
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

$response =  $nf->emmitNf($rps);
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
  $response->getXmlInput();
```

## getSuccess
Verifica o sucesso da operação realizada
```php
  $response->getSuccess();
```

## Classe Nf (NotaFiscalSP\Entities\Requests\Nf)
É a classe utilizada para referenciar uma Nota Fiscal já Existente, não é necessário preencher todas propriedades, apenas o NumeroNfe é o suficiente.
   
|          **Propriedade**           |          **Método**         |   **Tipo**   |
|:----------------------------------:|:---------------------------:|:------------:|
|         InscricaoPrestador         |   setInscricaoPrestador()   |      int     |
|              NumeroNfe             |        setNumeroNfe()       |      int     |
|          CodigoVerificacao         |    setCodigoVerificacao()   |    string    |
|              NumeroRPS             |        setNumeroRPS()       |      int     |
|              SerieRPS              |        setSerieRPS()        |    string    |


## Classe Period (NotaFiscalSP\Entities\Requests\Period)
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

## Classe Rps (NotaFiscalSP\Entities\Requests\Rps)
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