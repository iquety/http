<?php

declare(strict_types=1);

namespace Iquety\Http;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

interface HttpFactory extends
    RequestFactoryInterface,
    ResponseFactoryInterface,
    ServerRequestFactoryInterface,
    StreamFactoryInterface,
    UploadedFileFactoryInterface,
    UriFactoryInterface
{
    public function createRequestFromGlobals(): ServerRequestInterface;

    /** @param array<int|string,mixed>|string $content */
    public function createResponseJson(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface;

    /** @param array<int|string,mixed>|string $content */
    public function createResponseXml(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface;

    /** @param array<int|string,mixed>|string $content */
    public function createResponseHtml(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface;

    /** @param array<int|string,mixed>|string $content */
    public function createResponseText(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface;

    public function createRedirect(
        UriInterface $uri,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface;
}
