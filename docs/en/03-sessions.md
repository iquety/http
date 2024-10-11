# Sessions

[◂ Enumerations](02-enumerations.md) | [Documentation index](index.md) | [Evolving the library ▸](99-evolution.md)
-- | -- | --

## 1. Available implementations

To make the use of sessions more flexible, this library provides different implementations based on the same interface.

To use them, simply choose an available implementation:

| Implementação | Descrição | 
|:-- |:-- |
| Iquety\Http\Adapter\Session\MemorySession.php | Testing session | 
| Iquety\Http\Adapter\Session\NativeSession.php | PHP Native Session | 

## 2. Initializing a session

Starting a session.

```php
$session = new NativeSession();

$session->start();

$session->isStarted(); // true | false
```

Identifying the session

```php
$session = new NativeSession();

$session->start('session_id');

$session->setName('session_name');

$session->identity(); // session_id

$session->getName(); // session_name
```

## 3. Manipulating values

Assigning values ​​to the session

```php
$session = new NativeSession();

$session->start();

$session->setParam('login', 'napoleon');

$session->getParam('login'); // napoleon

$session->hasParam('login'); // true
$session->hasParam('non-existent'); // false
```

Obtaining individual values

```php
$session->getParam('login'); // napoleon

$session->getParam('non-existent'); // null

$session->getParam('non-existent', 'default_value'); // default_value
```

Changing multiple values

```php
$session->getParam('login'); // napoleon
$session->getParam('doc'); // null

$session->replaceParams([
    'login' => 'bonaparte',
    'doc' => 1234
]);

$session->getParam('login'); // bonaparte
$session->getParam('doc'); // 1234
```

Getting the list with all values

```php

$session->allParams(); // ['login' => 'napoleon', 'pass' => 'change@123']
```

Removing values

```php
// returns the value of 'login' and removes it
$session->forgetParam('login');

// just remove the 'login' value
$session->removeParam('login');

// returns the list with all values ​​and removes them all
$session->forgetAllParams();
```

Session cleanup

```php
// simply clears all session data
$session->clear();

// clears all session data and regenerates it.
$session->invalidate();
```

## 4. Handling messages

Adding messages to a form field

```php
// adds two messages in the 'login' field
$session->addFlash('login', 'Login too short');
$session->addFlash('login', 'Mandatory uppercase character');

// returns the list of fields and their messages
$session->allFlash(); // ['login' => ['Login too short', 'Mandatory uppercase character']]
```

Getting messages from a field

```php
// get only messages from the 'login' field
$session->getFlash('login'); // ['Login too short', 'Mandatory uppercase character']

// get default message when field does not exist
$session->getFlash('non-existent', ['Default message']); // ['Default message']
```

Getting the list with all messages

```php
// returns the list of fields and their messages
$session->allFlash(); // ['login' => ['Login too short', 'Mandatory uppercase character']]
```

Removing messages

```php
// returns the messages from the 'login' fields
// and then removes them
$session->forgetFlash('login'); // ['Login too short', 'Mandatory uppercase character']

// returns the list with all fields
// and their messages and then removes them all
$session->forgetAllFlash(); // ['doc' => ['Message'], 'pass' => ['Message']]
```

[◂ Enumerations](02-enumerations.md) | [Documentation index](index.md) | [Evolving the library ▸](99-evolution.md)
-- | -- | --
