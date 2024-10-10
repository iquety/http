<?php

declare(strict_types=1);

namespace Tests\Adapter\Session;

use Iquety\Http\Adapter\Session\MemorySession;
use Iquety\Http\Session;

class MemoryTest extends AbstractCase
{
    protected function makeFactory(): Session
    {
        return new MemorySession();
    }
}
