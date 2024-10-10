<?php

declare(strict_types=1);

namespace Tests\Adapter\HttpFactory;

use Iquety\Http\HttpFactory;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;
use Tests\TestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
abstract class AbstractStreamsCase extends TestCase
{
    abstract protected function makeFactory(): HttpFactory;

    /** @test */
    public function createStream(): void
    {
        $object = $this->makeFactory()->createStream('monomonomo');

        $this->assertInstanceOf(StreamInterface::class, $object);
    }

    /** @test */
    public function createStreamFromFile(): void
    {
        $object = $this->makeFactory()->createStreamFromFile(__DIR__ . '/streamfile.txt');

        $this->assertInstanceOf(StreamInterface::class, $object);
    }

    /** @test */
    public function createStreamFromResource(): void
    {
        /** @var resource $resource */
        $resource = fopen(__DIR__ . '/streamfile.txt', 'r');

        $object = $this->makeFactory()->createStreamFromResource($resource);

        $this->assertInstanceOf(StreamInterface::class, $object);
    }
}
