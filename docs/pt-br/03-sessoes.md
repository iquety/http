# Sessões

[◂ Enumerações](02-enumeracoes.md) | [Índice da documentação](indice.md) | [Evoluindo a biblioteca ▸](99-evoluindo.md)
-- | -- | --

## 1. Implementações disponíveis

Para flexibilizar o uso de sessões, esta biblioteca fornece implementações
diferenciadas com base em uma mesma interface.

Para usá-las, basta escolher uma implementação disponível:

| Implementação | Descrição |
|:-- |:-- |
| Iquety\Http\Adapter\Session\MemorySession.php | Sessão para testes |
| Iquety\Http\Adapter\Session\NativeSession.php | Sessão nativa do PHP |

## 2. Inicializando uma sessão

Iniciando uma sessão.

```php
$session = new NativeSession();

$session->start();

$session->isStarted(); // true | false
```

Identificando a sessão

```php
$session = new NativeSession();

$session->start('identificacao_da_sessao');

$session->setName('nome_da_sessao');

$session->identity(); // identificacao_da_sessao

$session->getName(); // nome_da_sessao
```

## 3. Manipulando valores

Atribuindo valores à sessão

```php
$session = new NativeSession();

$session->start();

$session->setParam('login', 'napoleao');

$session->getParam('login'); // napoleao

$session->hasParam('login'); // true
$session->hasParam('inexistente'); // false
```

Obtendo valores individuais

```php
$session->getParam('login'); // napoleao

$session->getParam('inexistente'); // null

$session->getParam('inexistente', 'valor_padrao'); // valor_padrao
```

Mudando vários valores

```php
$session->getParam('login'); // napoleao
$session->getParam('doc'); // null

$session->replaceParams([
    'login' => 'bonaparte',
    'doc' => 1234
]);

$session->getParam('login'); // bonaparte
$session->getParam('doc'); // 1234
```

Obtendo a lista com todos os valores

```php

$session->allParams(); // ['login' => 'napoleao', 'pass' => 'mudar@123']
```

Removendo valores

```php
// devolve o valor de 'login' e remove-o
$session->forgetParam('login');

// apenas remove o valor 'login'
$session->removeParam('login');

// devolve a lista com todos os valores e remove-os todos
$session->forgetAllParams();
```

Limpeza da sessão

```php
// simplesmente limpa todos os dados da sessão
$session->clear();

// limpa todos os dados da sessao e a regenera.
$session->invalidate();
```

## 4. Manipulando mensagens

Adicionando mensagens para um campo de formulário

```php
// adiciona duas mensagens no campo 'login'
$session->addFlash('login', 'Login muito curto');
$session->addFlash('login', 'Obrigatório caractere maiúsculo');

// devolve a lista de campos e suas mensagens
$session->allFlash(); // ['login' => ['Login muito curto', 'Obrigatório caractere maiúsculo']]
```

Obtendo mensagens de um campo

```php
// obtém apenas as mensagens do campo 'login'
$session->getFlash('login'); // ['Login muito curto', 'Obrigatório caractere maiúsculo']

// obtém a mensagem padrão quando o campo não existir
$session->getFlash('inexistente', ['Mensagem padrão']); // ['Mensagem padrão']
```

Obtendo a lista com todas as mensagens

```php
// devolve a lista de campos e suas mensagens
$session->allFlash(); // ['login' => ['Login muito curto', 'Obrigatório caractere maiúsculo']]
```

Removendo mensagens

```php
// devolve as mensagens do campos 'login'
// e remove-as em seguida
$session->forgetFlash('login'); // ['Login muito curto', 'Obrigatório caractere maiúsculo']

// devolve a lista com todos os campos
// e suas mensagens e remove todos em seguida
$session->forgetAllFlash(); // ['doc' => ['Mensagem'], 'pass' => ['Mensagem']]
```

[◂ Enumerações](02-enumeracoes.md) | [Índice da documentação](indice.md) | [Evoluindo a biblioteca ▸](99-evoluindo.md)
-- | -- | --
