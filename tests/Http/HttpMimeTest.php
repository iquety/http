<?php

declare(strict_types=1);

namespace Tests\Http;

use Iquety\Http\HttpMime;
use Tests\TestCase;

class HttpMimeTest extends TestCase
{
    /** @return array<int,array<int|string>> */
    public function mimeProvider(): array
    {
        return [
            [ 'HTML', 'text/html' ],
            [ 'JSON', 'application/json' ],
            [ 'TEXT', 'text/plain' ],
            [ 'XML', 'application/xml' ],
        ];
    }

    /**
     * @test
     * @dataProvider mimeProvider
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function mimes(string $constantName, string $mimeType): void
    {
        $this->assertTrue(defined(sprintf('%s::%s', HttpMime::class, $constantName)));

        $fromStatus = HttpMime::from($mimeType);

        $this->assertSame($constantName, $fromStatus->name);
        $this->assertSame($mimeType, $fromStatus->value);
    }

    /**
     * @test
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function allMimes(): void
    {
        $this->assertCount(4, HttpMime::all());
    }
}
