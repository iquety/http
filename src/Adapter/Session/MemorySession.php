<?php

declare(strict_types=1);

namespace Iquety\Http\Adapter\Session;

use Iquety\Http\Session;
use RuntimeException;

/** @SuppressWarnings(PHPMD.TooManyPublicMethods) */
class MemorySession implements Session
{
    /** @var array<int|string,mixed> */
    private static array $session = [];

    public function __construct()
    {
        // @phpstan-ignore-next-line
        static::$session = [ // @codeCoverageIgnore
            'id' => microtime(),
            'name' => '',
            'data' => [],
            'flash' => []
        ];
    }

    /**
     * Inicia uma sessão.
     * @throws RuntimeException se a inicialização falhar
     */
    public function start(string $identity = ''): void
    {
        static::$session['id'] = $identity; // @phpstan-ignore-line
    }

    /** Verifica se a sessão já foi iniciada */
    public function isStarted(): bool
    {
        return true;
    }

    /** Devolve o ID da sessão */
    public function identity(): string
    {
        return static::$session['id']; //@phpstan-ignore-line
    }

    /** Define o nome da sessão */
    public function setName(string $name): void
    {
        static::$session['name'] = $name; //@phpstan-ignore-line
    }

    /** Devolve o nome da sessão */
    public function getName(): string
    {
        return static::$session['name']; //@phpstan-ignore-line
    }

    /** Define um atributo */
    public function setParam(string $name, mixed $value): void
    {
        static::$session['data'][$name] = $value; //@phpstan-ignore-line
    }

    /** Devolve o valor de um atributo */
    public function getParam(string $name, mixed $default = null): mixed
    {
        return static::$session['data'][$name] ?? $default; //@phpstan-ignore-line
    }

    /** Verifica se o atributo já foi definido */
    public function hasParam(string $name): bool
    {
        return isset(static::$session['data'][$name]); //@phpstan-ignore-line
    }

    /** Devolve todos os atributos da sessão */
    public function allParams(): array
    {
        return static::$session['data']; //@phpstan-ignore-line
    }

    /** Define vários atributos */
    public function replaceParams(array $attributes): void
    {
        foreach ($attributes as $name => $value) {
            static::$session['data'][$name] = $value; //@phpstan-ignore-line
        }
    }

    /** Remove um atributo */
    public function removeParam(string $name): void
    {
        if ($this->hasParam($name) === false) {
            return;
        }

        unset(static::$session['data'][$name]); //@phpstan-ignore-line
    }

    /** Devolve o valor e remove o atributo ao mesmo tempo */
    public function forgetParam(string $name): mixed
    {
        $value = $this->getParam($name);

        $this->removeParam($name);

        return $value;
    }

    /** Limpa todos os atributos da sessão */
    public function clear(): void
    {
        static::$session['data'] = []; //@phpstan-ignore-line
        static::$session['flash'] = []; //@phpstan-ignore-line
    }

    /**
     * Limpa os atributos da memória e regenera a sessão.
     * Se existirem atributos pesistidos, remove-os também.
     * @param int $lifetime tempo de vida do cookie em segundos
     * A null value will leave the system settings unchanged,
     * 0 sets the cookie to expire with browser session.
     * Time is in seconds, and is not a Unix timestamp.
     */
    public function invalidate(int $lifetime = null): void
    {
        static::$session['id'] = microtime(); //@phpstan-ignore-line
        static::$session['data'] = []; //@phpstan-ignore-line
    }

    /** Adiciona uma mensagem ao campo especificado */
    public function addFlash(string $field, string $message): void
    {
        if (isset(static::$session['flash'][$field]) === false) { // @phpstan-ignore-line
            static::$session['flash'][$field] = []; // @phpstan-ignore-line
        }

        static::$session['flash'][$field][] = $message; // @phpstan-ignore-line
    }

    /**
     * Devolve as mensagens do campo especificado e remove-a ao mesmo tempo
     * @param array<int,string> $defaultMessages
     * @return array<int,string>
     */
    public function forgetFlash(string $field, array $defaultMessages = []): array
    {
        if (isset(static::$session['flash'][$field]) === false) { // @phpstan-ignore-line
            return $defaultMessages;
        }

        $messages = static::$session['flash'][$field]; // @phpstan-ignore-line

        unset(static::$session['flash'][$field]); // @phpstan-ignore-line

        return $messages;
    }

    /**
     * Devolve todas as mensagens e remove-as ao mesmo tempo
     * @return array<int,string>
     */
    public function forgetAllFlash(): array
    {
        $all = static::$session['flash']; // @phpstan-ignore-line

        static::$session['flash'] = []; // @phpstan-ignore-line

        return $all;
    }

    /**
     * Devolve as mensagens do campo especificado
     * @param array<int,string> $defaultMessages
     * @return array<int,string>
     */
    public function getFlash(string $field, array $defaultMessages = []): array
    {
        if (isset(static::$session['flash'][$field]) === false) { // @phpstan-ignore-line
            return $defaultMessages;
        }

        return static::$session['flash'][$field]; // @phpstan-ignore-line
    }

    /** @return array<int,string> */
    public function allFlash(): array
    {
        return static::$session['flash']; //@phpstan-ignore-line
    }
}
