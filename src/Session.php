<?php

declare(strict_types=1);

namespace Iquety\Http;

use RuntimeException;

interface Session
{
    /**
     * Inicia uma sessão.
     * @throws RuntimeException se a inicialização falhar
     */
    public function start(string $identity = ''): void;

    /** Verifica se a sessão já foi iniciada */
    public function isStarted(): bool;

    /** Devolve o ID da sessão */
    public function identity(): string;

    /**
     * Define o nome da sessão
     */
    public function setName(string $name): void;

    /** Devolve o nome da sessão */
    public function getName(): string;

    /** Define um atributo */
    public function setParam(string $name, mixed $value): void;

    /** Devolve o valor de um atributo */
    public function getParam(string $name, mixed $default = null): mixed;

    /** Verifica se o atributo já foi definido */
    public function hasParam(string $name): bool;

    /**
     * Devolve todos os atributos da sessão
     * @return array<string,mixed>
     */
    public function allParams(): array;

    /**
     * Define vários atributos
     * @param array<string,mixed> $attributes
     */
    public function replaceParams(array $attributes): void;

    /** Remove um atributo */
    public function removeParam(string $name): void;

    /** Devolve o valor e remove o atributo ao mesmo tempo */
    public function forgetParam(string $name): mixed;

    /** Limpa todos os atributos da sessão */
    public function clear(): void;

    /**
     * Limpa os atributos da memória e regenera a sessão.
     * Se existirem atributos pesistidos, remove-os também.
     * @param int $lifetime tempo de vida do cookie em segundos
     * @throws RuntimeException se a invalidação falhar
     */
    public function invalidate(int $lifetime = null): void;

    /** Adiciona uma mensagem ao campo especificado */
    public function addFlash(string $field, string $message): void;

    /**
     * Devolve as mensagens do campo especificado e remove-a ao mesmo tempo
     * @param array<int,string> $defaultMessages
     * @return array<int,string>
     */
    public function forgetFlash(string $field, array $defaultMessages = []): array;

    /**
     * Devolve todas as mensagens e remove-as ao mesmo tempo
     * @return array<int,string>
     */
    public function forgetAllFlash(): array;

    /**
     * Devolve as mensagens do campo especificado
     * @param array<int,string> $defaultMessages
     * @return array<int,string>
     */
    public function getFlash(string $field, array $defaultMessages = []): array;

    /** @return array<int,string> */
    public function allFlash(): array;
}
