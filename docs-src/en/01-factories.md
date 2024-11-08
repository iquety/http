# Factories

--page-nav--

## 1. Available implementations

This library provides implementations for the factories suggested in PSR 7, while unifying them all into a single interface.

To use them, simply choose an available implementation:

| Implementation                                           | Description       |
| :------------------------------------------------------- | :---------------- |
| Iquety\Http\Adapter\HttpFactory\DiactorosHttpFactory.php | Laminas Diactoros |
| Iquety\Http\Adapter\HttpFactory\GuzzleHttpFactory.php    | Guzzle Http       |
| Iquety\Http\Adapter\HttpFactory\NyHolmHttpFactory.php    | NyHolm            |

## 2. Make a URI

Creates a representation of a URI:

```php
$factories = new DiactorosHttpFactory();
$factories->createUri('/');
```

## 3. Make requisitions

Creates a server request using the data provided in the available global variables:

```php
$factories = new DiactorosHttpFactory();
$factories->createRequestFromGlobals();
```

Create a simple request:

```php
$factories = new DiactorosHttpFactory();

$factories->createRequest(
    'POST', // Verb used in the request
    $factories->createUri('/')
);
```

Creates a server request:

```php
$factories = new DiactorosHttpFactory();
$factories->createServerRequest(
    'POST', // Verb used in the request
    $factories->createUri('/')
    [] // Server variables
);
```

## 4. Make responses

Create a simple response:

```php
$factories = new DiactorosHttpFactory();
$factories->createResponse(
    200, // Status Http
    'Ok' // Status Reason
);
```

Create a JSON response:

```php
$factories = new DiactorosHttpFactory();
$factories->createResponseJson(
    ['response' => 'content'],
    HttpStatus::OK
);
```

Create a XML response:

```php
$factories = new DiactorosHttpFactory();
$factories->createResponseXml(
    ['response' => 'content'],
    HttpStatus::OK
);
```

Create a HTML response:

```php
$factories = new DiactorosHttpFactory();
$factories->createResponseHtml(
    '<html>...</html>',
    HttpStatus::OK
);
```

Create a plain text response:

```php
$factories = new DiactorosHttpFactory();
$factories->createResponseText(
    'monomon monomon mon',
    HttpStatus::OK
);
```

Create a redirect response:

```php
$factories = new DiactorosHttpFactory();
$factories->createRedirect(
    $factories->createUri('/destination'),
    HttpStatus::FOUND
);
```

## 5. Make data streams

Create a text message:

```php
$factories = new DiactorosHttpFactory();
$factories->createStream('My text');
```

Creates a text message from the contents of a file:

```php
$factories = new DiactorosHttpFactory();
$factories->createStreamFromFile('streamfile.txt', 'r');
```

Creates a text message from an open resource:

```php
$resource = fopen('streamfile.txt', 'r');

$factories = new DiactorosHttpFactory();
$factories->createStreamFromResource($resource);
```

## 6. Make files

Creates a representation of a file:

```php
$factories = new DiactorosHttpFactory();
$factories->createUploadedFile(
    $factories->createStreamFromFile('my-file.txt', 'r'),
    123456, // stream size in bytes
    \UPLOAD_ERR_OK, // corresponding situation
    'my-file.txt', // file name
    'text/plain' // mime type
);
```

> **Note:** to see the list of constants used for the corresponding file situation,
visit [Predefined Constants](https://www.php.net/manual/en/filesystem.constants.php) in the
PHP manual

--page-nav--
