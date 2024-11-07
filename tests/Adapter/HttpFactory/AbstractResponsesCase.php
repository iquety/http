<?php

declare(strict_types=1);

namespace Tests\Adapter\HttpFactory;

use Iquety\Http\HttpFactory;
use InvalidArgumentException;
use Iquety\Http\HttpMime;
use Iquety\Http\HttpStatus;
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
abstract class AbstractResponsesCase extends TestCase
{
    abstract protected function makeFactory(): HttpFactory;

    /** @test */
    public function createResponse(): void
    {
        $object = $this->makeFactory()->createResponse();

        $this->assertInstanceOf(ResponseInterface::class, $object);
    }

    /** @return array<string,array<int,mixed>> */
    public function jsonProvider(): array
    {
        $list = [];

        $list['empty'] = ['', ''];

        $list['string'] = ['conteudo', '{"content":"conteudo"}'];

        $list['array'] = [ ['value'], '["value"]' ];

        $list['array sub'] = [
            ['name' => ['value']],
            '{"name":["value"]}'
        ];

        $list['object'] = [ ['name' => 'value'], '{"name":"value"}' ];

        $list['objext sub'] = [
            ['name' => ['sub' => 'value']],
            '{"name":{"sub":"value"}}'
        ];

        return $list;
    }

    /**
     * @test
     * @dataProvider jsonProvider
     * @param string|array<mixed> $content
     */
    public function createResponseJson(string|array $content, string $body): void
    {
        $response = $this->makeFactory()->createResponseJson($content, HttpStatus::ACCEPTED);

        $this->assertSame(
            HttpStatus::ACCEPTED->value,
            $response->getStatusCode()
        );

        $this->assertSame(
            HttpStatus::ACCEPTED->reason(),
            $response->getReasonPhrase()
        );

        $this->assertSame($body, (string)$response->getBody());

        $this->assertTrue($response->hasHeader('Content-type'));

        $this->assertSame(HttpMime::JSON->value, $response->getHeaderLine('Content-type'));
    }

    /** @return array<string,array<int,mixed>> */
    public function xmlProvider(): array
    {
        $list = [];

        $list['empty'] = [
            '',
            "<?xml version=\"1.0\"?>\n<root><content/></root>\n"
        ];
        $list['string'] = [
            'conteudo',
            "<?xml version=\"1.0\"?>\n<root><content>conteudo</content></root>\n"
        ];

        $list['array'] = [
            ['name' => 'value'],
            "<?xml version=\"1.0\"?>\n<root><name>value</name></root>\n"
        ];

        $list['array'] = [
            ['name' => ['sub' => 'value']],
            "<?xml version=\"1.0\"?>\n<root><name><sub>value</sub></name></root>\n"
        ];

        $list['array'] = [
            ['name' => [2 => 'value']],
            "<?xml version=\"1.0\"?>\n<root><name><item>value</item></name></root>\n"
        ];

        return $list;
    }

    /**
     * @test
     * @dataProvider xmlProvider
     * @param string|array<mixed> $content
     */
    public function createResponseXml(string|array $content, string $body): void
    {
        $response = $this->makeFactory()->createResponseXml($content, HttpStatus::ACCEPTED);

        $this->assertSame(
            HttpStatus::ACCEPTED->value,
            $response->getStatusCode()
        );

        $this->assertSame(
            HttpStatus::ACCEPTED->reason(),
            $response->getReasonPhrase()
        );

        $this->assertSame($body, (string)$response->getBody());

        $this->assertTrue($response->hasHeader('Content-type'));

        $this->assertSame(HttpMime::XML->value, $response->getHeaderLine('Content-type'));
    }

    /** @return array<string,array<int,mixed>> */
    public function htmlProvider(): array
    {
        $list = [];

        $list['empty'] = [
            '',
            ""
        ];
        $list['string'] = [
            'conteudo',
            "conteudo"
        ];

        $list['array'] = [
            ['name' => 'value'],
            "name=value\n"
        ];

        $list['array'] = [
            ['name' => ['sub' => 'value']],
            "name\n  sub=value\n"
        ];

        $list['array'] = [
            ['name' => [3 => 'value']],
            "name\n  3=value\n"
        ];

        return $list;
    }

    /**
     * @test
     * @dataProvider htmlProvider
     * @param string|array<mixed> $content
     */
    public function createResponseHtml(string|array $content, string $body): void
    {
        $response = $this->makeFactory()->createResponseHtml($content, HttpStatus::ACCEPTED);

        $this->assertSame(
            HttpStatus::ACCEPTED->value,
            $response->getStatusCode()
        );

        $this->assertSame(
            HttpStatus::ACCEPTED->reason(),
            $response->getReasonPhrase()
        );

        $this->assertSame($body, (string)$response->getBody());

        $this->assertTrue($response->hasHeader('Content-type'));

        $this->assertSame(HttpMime::HTML->value, $response->getHeaderLine('Content-type'));
    }

    /** @return array<string,array<int,mixed>> */
    public function textProvider(): array
    {
        $list = [];

        $list['empty'] = [
            '',
            ""
        ];
        $list['string'] = [
            'conteudo',
            "conteudo"
        ];

        $list['array'] = [
            ['name' => 'value'],
            "name=value\n"
        ];

        $list['array'] = [
            ['name' => ['sub' => 'value']],
            "name\n  sub=value\n"
        ];

        $list['array'] = [
            ['name' => [3 => 'value']],
            "name\n  3=value\n"
        ];

        return $list;
    }

    /**
     * @test
     * @dataProvider textProvider
     * @param string|array<mixed> $content
     */
    public function createResponseText(string|array $content, string $body): void
    {
        $response = $this->makeFactory()->createResponseText($content, HttpStatus::ACCEPTED);

        $this->assertSame(
            HttpStatus::ACCEPTED->value,
            $response->getStatusCode()
        );

        $this->assertSame(
            HttpStatus::ACCEPTED->reason(),
            $response->getReasonPhrase()
        );

        $this->assertSame($body, (string)$response->getBody());

        $this->assertTrue($response->hasHeader('Content-type'));

        $this->assertSame(HttpMime::TEXT->value, $response->getHeaderLine('Content-type'));
    }
}
