# NFe-NFTS-SP (PHP)
O objetivo principal do Projeto é facilitar a emissão de Nota Fiscal de Serviço / Nota Fiscal de Tomador de Serviço  (NF, NFAsync, NFTS).

## Extensões Necessárias 
- Soap
- openssl

```php
  // Instanciando a Classe
  $nfSP = new NotaFiscal([
      'cnpj' => '00000000000000',
      'certificate' => 'path/to/certificate.pfx',
      'certificatePass' => '000000'
  ]);
```
