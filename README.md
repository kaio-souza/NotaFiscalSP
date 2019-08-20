# NFe-NFTS-SP (PHP)
O objetivo principal do Projeto é facilitar a emissão de Nota Fiscal de Serviço / Nota Fiscal de Tomador de Serviço  (NF, NFAsync, NFTS).

### Extensões Necessárias 
- Soap
- openssl

## Instanciando a Classe

```php
  // Instanciando a Classe
  $nfSP = new NotaFiscal([
      'cnpj' => '00000000000000',
      'certificate' => 'path/to/certificate.pfx',
      'certificatePass' => '000000'
  ]);
```

## Obtendo Informações Base do CNPJ
```php
$response = $nf->cnpjInformation();
```
## Obtendo Informações Basicas do Lote
```php
$response = $nf->lotInformation();
```

## Consultando Nota Fiscal
```php
$response = $nf->checkNf([
    [SimpleFieldsConstants::NFE_NUMBER => 235 ],
    [SimpleFieldsConstants::NFE_NUMBER => 238 ],
]);
```

## Consultando Lote
```php
$response = $nf->checkLot(356);
```

## Cancelando Nota Fiscal
```php
$response = $nf->cancelNf([
    [SimpleFieldsConstants::NFE_NUMBER => 235 ],
    [SimpleFieldsConstants::NFE_NUMBER => 238 ],
]);
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
