# Fabricas

[◂ Índice da documentação](indice.md) | [Enumerações ▸](02-enumeracoes.md)
-- | --

## 1. Implementações disponíveis

Esta biblioteca fornece implementações para as fábricas sugeridas na PSR 7, ao mesmo tempo que as unifica todas elas em uma interface única.

Para usá-las, basta escolher uma implementação disponível:

| Implementação                                            | Descrição         |
| :------------------------------------------------------- | :---------------- |
| Iquety\Http\Adapter\HttpFactory\DiactorosHttpFactory.php | Laminas Diactoros |
| Iquety\Http\Adapter\HttpFactory\GuzzleHttpFactory.php    | Guzzle Http       |
| Iquety\Http\Adapter\HttpFactory\NyHolmHttpFactory.php    | NyHolm            |

## 2. Fabricar URI

Cria a representação de um URI:

```php
$factories = new DiactorosHttpFactory();
$factories->createUri('/');
```

## 3. Fabricar requisições

Cria uma requisição de servidor usando os dados fornecidos nas variáveis globais disponíveis:

```php
$factories = new DiactorosHttpFactory();
$factories->createRequestFromGlobals();
```

Cria uma requisição simples:

```php
$factories = new DiactorosHttpFactory();

$factories->createRequest(
    'POST', // Verbo usado na requisição
    $factories->createUri('/')
);
```

Cria uma requisição de servidor:

```php
$factories = new DiactorosHttpFactory();
$factories->createServerRequest(
    'POST', // Verbo usado na requisição
    $factories->createUri('/')
    [] // Variáveis do servidor
);
```

## 4. Fabricar respostas

Cria uma resposta simples:

```php
$factories = new DiactorosHttpFactory();
$factories->createResponse(
    200, // Status Http
    'Ok' // Motivo do Status
);
```

## 5. Fabricar fluxos de dados

Cria uma mensagem de texto:

```php
$factories = new DiactorosHttpFactory();
$factories->createStream('Meu texto');
```

Cria uma mensagem de texto a partir do conteúdo de um arquivo:

```php
$factories = new DiactorosHttpFactory();
$factories->createStreamFromFile('streamfile.txt', 'r');
```

Cria uma mensagem de texto a partir de um recurso aberto:

```php
$resource = fopen('streamfile.txt', 'r');

$factories = new DiactorosHttpFactory();
$factories->createStreamFromResource($resource);
```

## 6. Fabricar arquivo

Cria a representação de um arquivo:

```php
$factories = new DiactorosHttpFactory();
$factories->createUploadedFile(
    $factories->createStreamFromFile('meu-arquivo.txt', 'r'),
    123456, // tamanho do fluxo em bytes
    \UPLOAD_ERR_OK, // situação correspondente
    'meu-arquivo.txt', // nome do arquivo
    'text/plain' // tipo mime
);
```

> **Nota:** para ver a lista de constantes usadas para a situação correspondente ao arquivo,
visite [Predefined Constants](https://www.php.net/manual/en/filesystem.constants.php) no
manual do PHP

[◂ Índice da documentação](indice.md) | [Enumerações ▸](02-enumeracoes.md)
-- | --
