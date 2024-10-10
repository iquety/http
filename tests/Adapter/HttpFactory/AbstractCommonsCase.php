<?php

declare(strict_types=1);

namespace Tests\Adapter\HttpFactory;

use Iquety\Http\HttpFactory;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;
use Tests\TestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
abstract class AbstractCommonsCase extends TestCase
{
    abstract protected function makeFactory(): HttpFactory;

    /** @test */
    public function createUploadedFile(): void
    {
        $stream = $this->makeFactory()->createStream('monomonom');
        $object = $this->makeFactory()->createUploadedFile($stream);

        $this->assertInstanceOf(UploadedFileInterface::class, $object);
    }

    /** @test */
    public function createUri(): void
    {
        $object = $this->makeFactory()->createUri('http://www.google.com/teste');

        $this->assertInstanceOf(UriInterface::class, $object);
    }
}
