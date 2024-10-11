<?php

declare(strict_types=1);

namespace Tests\Adapter\Session;

use Iquety\Http\Session;
use Tests\TestCase;

/** @SuppressWarnings(PHPMD.TooManyPublicMethods) */
abstract class AbstractCase extends TestCase
{
    abstract protected function makeFactory(): Session;

    /** @test */
    public function start(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $this->assertTrue($session->isStarted());
    }

    /** @test */
    public function startWithId(): void
    {
        $session = $this->makeFactory();
        $session->start('aaa');

        $this->assertTrue($session->isStarted());
        $this->assertEquals('aaa', $session->identity());
    }

    /** @test */
    public function name(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->setName('yyy');
        $this->assertEquals('yyy', $session->getName());
    }

    /** @test */
    public function param(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->setParam('aaa', 'bbb');

        $this->assertEquals('bbb', $session->getParam('aaa'));
        $this->assertEquals('bbb', $session->getParam('aaa'));

        $this->assertEquals('ddd', $session->getParam('hhh', 'ddd'));
        $this->assertEquals('ddd', $session->getParam('hhh', 'ddd'));

        $this->assertNull($session->getParam('hhh'));
    }

    /** @test */
    public function forget(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->setParam('aaa', 'bbb');

        $this->assertEquals('bbb', $session->forgetParam('aaa'));
        $this->assertNull($session->forgetParam('aaa'));
    }

    /** @test */
    public function all(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->setParam('aaa', 'bbb');

        $this->assertCount(1, $session->allParams());
    }

    /** @test */
    public function replace(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->replaceParams(['aaa' => 'bbb']);
        $this->assertCount(1, $session->allParams());

        $session->replaceParams(['aaa' => 'bbb', 'ccc' => 'ddd']);
        $this->assertCount(2, $session->allParams());
    }

    /** @test */
    public function remove(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->setParam('aaa', 'bbb');
        $this->assertEquals('bbb', $session->getParam('aaa'));

        $session->removeParam('aaa');
        $this->assertNull($session->getParam('aaa'));
    }

    /** @test */
    public function clear(): void
    {
        $session = $this->makeFactory();
        $session->start('aaa');
        $this->assertCount(0, $session->allParams());

        $session->setName('bbb');
        $session->setParam('ccc', 'zzz');
        $session->addFlash('name', 'O nome fornecido é inválido');

        $this->assertCount(1, $session->allParams());
        $this->assertEquals('aaa', $session->identity());
        $this->assertEquals('bbb', $session->getName());
        $this->assertEquals(
            ['O nome fornecido é inválido'],
            $session->getFlash('name')
        );

        $this->assertEquals('zzz', $session->getParam('ccc'));

        $session->clear();

        // id e nome não mudam após a limpeza
        $this->assertEquals('aaa', $session->identity());
        $this->assertEquals('bbb', $session->getName());
        $this->assertEquals(
            [],
            $session->getFlash('name')
        );

        $this->assertNull($session->getParam('ccc'));
    }

    /** @test */
    public function invalidate(): void
    {
        $session = $this->makeFactory();
        $session->start('aaa');
        $this->assertCount(0, $session->allParams());

        $session->setName('bbb');
        $session->setParam('ccc', 'zzz');

        $this->assertCount(1, $session->allParams());
        $this->assertEquals('aaa', $session->identity());
        $this->assertEquals('bbb', $session->getName());
        $this->assertEquals('zzz', $session->getParam('ccc'));

        $session->invalidate();

        // A sessao regenerada tem identificacao diferente
        $this->assertNotEquals('aaa', $session->identity());

        // A sessao regenerada tem o mesmo nome
        $this->assertEquals('bbb', $session->getName());

        // A sessao regenerada não possui dados
        $this->assertNull($session->getParam('ccc'));
        $this->assertCount(0, $session->allParams());
    }

    /** @test */
    public function has(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->setParam('abc', 'monomono');
        $this->assertTrue($session->hasParam('abc'));
    }

    /** @test */
    public function addFlash(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->addFlash('abc', 'hahahah');
        $session->addFlash('abc', 'hohohoh');

        $this->assertSame([
            'hahahah',
            'hohohoh'
        ], $session->getFlash('abc'));
    }

    /** @test */
    public function getFlash(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->addFlash('abc', 'hahahah');
        $session->addFlash('abc', 'hohohoh');

        $this->assertSame([
            'hahahah',
            'hohohoh'
        ], $session->getFlash('abc'));

        $this->assertSame([
            'hahahah',
            'hohohoh'
        ], $session->getFlash('abc'));
    }

    /** @test */
    public function forgetFlash(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->addFlash('abc', 'hahahah');
        $session->addFlash('abc', 'hohohoh');

        $this->assertSame([
            'hahahah',
            'hohohoh'
        ], $session->forgetFlash('abc'));

        $this->assertSame([], $session->forgetFlash('abc'));
    }

    /** @test */
    public function allFlash(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->addFlash('abc', 'hahahah');
        $session->addFlash('abc', 'hohohoh');

        $this->assertSame([
            'abc' => [
                'hahahah',
                'hohohoh'
            ]
        ], $session->allFlash());

        $this->assertSame([
            'abc' => [
                'hahahah',
                'hohohoh'
            ]
        ], $session->allFlash());
    }

    /** @test */
    public function forgetAllFlash(): void
    {
        $session = $this->makeFactory();
        $session->start();

        $session->addFlash('abc', 'hahahah');
        $session->addFlash('abc', 'hohohoh');

        $this->assertSame([
            'abc' => [
                'hahahah',
                'hohohoh'
            ]
        ], $session->forgetAllFlash());

        $this->assertSame([], $session->forgetAllFlash());
    }
}
