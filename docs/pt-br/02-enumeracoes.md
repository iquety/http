# Enumerações

[◂ Fabricas](01-fabricas.md) | [Índice da documentação](indice.md) | [Sessões ▸](03-sessoes.md)
-- | -- | --

## 1. HttpMethod

Enumeração dos verbos disponíveis para efetuar requisições:

```php
HttpMethod::ANY
HttpMethod::DELETE
HttpMethod::GET   
HttpMethod::PATCH 
HttpMethod::POST  
HttpMethod::PUT   
```

Para fabricar uma opção com base no valor:

```php
HttpMethod::from('POST')
```

Para devolver a lista de verbos:

```php
HttpMethod::all()
```

## 2. HttpMime

Enumeração dos tipos mime disponíveis para efetuar requisições e respostas:

```php
HttpMime::HTML // text/html
HttpMime::JSON // application/json
HttpMime::TEXT // text/plain
HttpMime::XML // application/xml
```

Para fabricar uma opção com base no valor:

```php
HttpMime::from('text/html')
```

Para devolver a lista de tipos suportados:

```php
HttpMime::all()
```

## 3. HttpStatus

Enumeração dos tipos mime disponíveis para efetuar requisições e respostas:

```php
HttpStatus::CONTINUE // 100;
HttpStatus::SWITCHING_PROTOCOLS // 101
HttpStatus::PROCESSING // 102
HttpStatus::EARLY_HINTS // 103
HttpStatus::OK // 200
HttpStatus::CREATED // 201
HttpStatus::ACCEPTED // 202
HttpStatus::NON_AUTHORITATIVE_INFORMATION // 203
HttpStatus::NO_CONTENT // 204
HttpStatus::RESET_CONTENT // 205
HttpStatus::PARTIAL_CONTENT // 206
HttpStatus::MULTI_STATUS // 207
HttpStatus::ALREADY_REPORTED // 208
HttpStatus::IM_USED // 226
HttpStatus::MULTIPLE_CHOICES // 300
HttpStatus::MOVED_PERMANENTLY // 301
HttpStatus::FOUND // 302
HttpStatus::SEE_OTHER // 303
HttpStatus::NOT_MODIFIED // 304
HttpStatus::USE_PROXY // 305
HttpStatus::TEMPORARY_REDIRECT // 307
HttpStatus::PERMANENTLY_REDIRECT // 308
HttpStatus::BAD_REQUEST // 400
HttpStatus::UNAUTHORIZED // 401
HttpStatus::PAYMENT_REQUIRED // 402
HttpStatus::FORBIDDEN // 403
HttpStatus::NOT_FOUND // 404
HttpStatus::METHOD_NOT_ALLOWED // 405
HttpStatus::NOT_ACCEPTABLE // 406
HttpStatus::PROXY_AUTHENTICATION_REQUIRED // 407
HttpStatus::REQUEST_TIMEOUT // 408
HttpStatus::CONFLICT // 409
HttpStatus::GONE // 410
HttpStatus::LENGTH_REQUIRED // 411
HttpStatus::PRECONDITION_FAILED // 412
HttpStatus::REQUEST_ENTITY_TOO_LARGE // 413
HttpStatus::REQUEST_URI_TOO_LONG // 414
HttpStatus::UNSUPPORTED_MEDIA_TYPE // 415
HttpStatus::REQUESTED_RANGE_NOT_SATISFIABLE // 416
HttpStatus::EXPECTATION_FAILED // 417
HttpStatus::I_AM_A_TEAPOT // 418
HttpStatus::MISDIRECTED_REQUEST // 421
HttpStatus::UNPROCESSABLE_ENTITY // 422
HttpStatus::LOCKED // 423
HttpStatus::FAILED_DEPENDENCY // 424
HttpStatus::TOO_EARLY // 425
HttpStatus::UPGRADE_REQUIRED // 426
HttpStatus::PRECONDITION_REQUIRED // 428
HttpStatus::TOO_MANY_REQUESTS // 429
HttpStatus::REQUEST_HEADER_FIELDS_TOO_LARGE // 431
HttpStatus::UNAVAILABLE_FOR_LEGAL_REASONS // 451
HttpStatus::INTERNAL_SERVER_ERROR // 500
HttpStatus::NOT_IMPLEMENTED // 501
HttpStatus::BAD_GATEWAY // 502
HttpStatus::SERVICE_UNAVAILABLE // 503
HttpStatus::GATEWAY_TIMEOUT // 504
HttpStatus::VERSION_NOT_SUPPORTED // 505
HttpStatus::VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL // 506
HttpStatus::INSUFFICIENT_STORAGE // 507
HttpStatus::LOOP_DETECTED // 508
HttpStatus::NOT_EXTENDED // 510
HttpStatus::NETWORK_AUTHENTICATION_REQUIRED // 511
```

Para devolver a frase de motivo do Status Http:

```php
HttpStatus::NOT_FOUND->reason() // Not Found
```

Para fabricar uma opção com base no valor:

```php
HttpStatus::from('404') // HttpMime::NOT_FOUND
```

Para devolver a lista de status suportados:

```php
HttpStatus::all()
```

[◂ Fabricas](01-fabricas.md) | [Índice da documentação](indice.md) | [Sessões ▸](03-sessoes.md)
-- | -- | --
