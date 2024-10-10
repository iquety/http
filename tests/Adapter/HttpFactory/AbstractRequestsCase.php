<?php

declare(strict_types=1);

namespace Tests\Adapter\HttpFactory;

use Iquety\Http\HttpFactory;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;
use Tests\TestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
abstract class AbstractRequestsCase extends TestCase
{
    abstract protected function makeFactory(): HttpFactory;

    /** @test */
    public function createRequestFromGlobals(): void
    {
        $object = $this->makeFactory()->createRequestFromGlobals();

        $this->assertInstanceOf(ServerRequestInterface::class, $object);
    }

    /** @test */
    public function createRequest(): void
    {
        $object = $this->makeFactory()->createRequest('POST', '/user/33');

        $this->assertInstanceOf(RequestInterface::class, $object);
    }

    /** @test */
    public function createServerRequest(): void
    {
        $object = $this->makeFactory()->createServerRequest('POST', '/user/33', []);

        $this->assertInstanceOf(ServerRequestInterface::class, $object);
    }

    /** @test */
    public function createServerRequestEmptyMethod(): void
    {
        $object = $this->makeFactory()->createServerRequest('', '/user/33', [
            'REQUEST_METHOD' => 'POST'
        ]);

        $this->assertInstanceOf(ServerRequestInterface::class, $object);
    }

    /** @test */
    public function createServerRequestException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot determine HTTP method');

        $this->makeFactory()->createServerRequest('', '/user/33', []);
    }
}
