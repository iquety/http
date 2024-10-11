<?php

declare(strict_types=1);

namespace Iquety\Http\Adapter\HttpFactory;

use Iquety\Http\HttpMime;
use Iquety\Http\HttpStatus;
use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

/**
 * @method ResponseInterface createResponse(int $code = 200, string $reasonPhrase = '')
 */
trait ResponseTypes
{
    /**
     * @param array<int|string,mixed>|string $content
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function createResponseJson(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface {
        $response = $this->createResponse(
            $status->value,
            HttpStatus::from($status->value)->reason()
        );

        $resolvedContent = $this->createStream(
            $this->makeJsonResponse($content)
        );

        return $response
            ->withHeader('Content-type', HttpMime::JSON->value)
            ->withBody($resolvedContent);
    }

    /**
     * @param array<int|string,mixed>|string $content
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function createResponseXml(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface {
        $response = $this->createResponse(
            $status->value,
            HttpStatus::from($status->value)->reason()
        );

        $resolvedContent = $this->createStream(
            $this->makeXmlResponse($content)
        );

        return $response
            ->withHeader('Content-type', HttpMime::XML->value)
            ->withBody($resolvedContent);
    }

    /**
     * @param array<int|string,mixed>|string $content
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function createResponseHtml(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface {
        $response = $this->createResponse(
            $status->value,
            HttpStatus::from($status->value)->reason()
        );

        $resolvedContent = $this->createStream(
            $this->makeHtmlResponse($content)
        );

        return $response
            ->withHeader('Content-type', HttpMime::HTML->value)
            ->withBody($resolvedContent);
    }

    /**
     * @param array<int|string,mixed>|string $content
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function createResponseText(
        array|string $content,
        HttpStatus $status = HttpStatus::OK
    ): ResponseInterface {
        $response = $this->createResponse(
            $status->value,
            HttpStatus::from($status->value)->reason()
        );

        $resolvedContent = $this->createStream(
            $this->makeTextResponse($content)
        );

        return $response
            ->withHeader('Content-type', HttpMime::TEXT->value)
            ->withBody($resolvedContent);
    }

    /** @param array<int|string,mixed>|string $content */
    private function makeHtmlResponse(array|string $content): string
    {
        if (is_array($content) === true) {
            return $this->makeTextResponse($content);
        }

        return $content;
    }

    /** @param array<int|string,mixed>|string $content */
    private function makeJsonResponse(array|string $content): string
    {
        if ($content === '') {
            return '';
        }

        if (is_string($content) === true) {
            $content = [ 'content' => $content ];
        }

        return (string)json_encode($content, JSON_FORCE_OBJECT);
    }

    /** @param array<int|string,mixed>|string $content */
    private function makeTextResponse(array|string $content, int $level = 0): string
    {
        if (is_array($content) === false) {
            return $content;
        }

        $padding = str_repeat('  ', $level);

        $textualContent = '';

        foreach ($content as $name => $value) {
            if (is_array($value) === true) {
                $textualContent .= "$padding$name\n" . $this->makeTextResponse($value, $level + 1);
                continue;
            }

            $textualContent .= "$padding$name=$value\n";
        }

        return $textualContent;
    }

    /** @param array<int|string,mixed>|string $content */
    private function makeXmlResponse(array|string $content): string
    {
        if (is_string($content) === true) {
            $content = [ 'content' => $content ];
        }

        $mainElement = new SimpleXMLElement('<root/>');

        return $this->arrayToXml($content, $mainElement);
    }

    /** @param array<int|string,mixed> $content */
    private function arrayToXml(array $content, SimpleXMLElement $element): string
    {
        foreach ($content as $tag => $value) {
            if (is_numeric($tag) === true) {
                $tag = 'item';
            }

            if (is_array($value) === true) {
                $this->arrayToXml($value, $element->addChild((string)$tag));

                continue;
            }

            $element->addChild(
                (string)$tag,
                (string)htmlentities((string)$value)
            );
        }

        return (string)$element->asXML();
    }
}
