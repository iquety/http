<?php

declare(strict_types=1);

namespace Tests\Adapter\Session;

use Iquety\Http\Adapter\Session\NativeSession;
use Iquety\Http\Session;

class NativeTest extends AbstractCase
{
    protected function makeFactory(): Session
    {
        $session = new NativeSession();
        $session->enableTestMode();
        return $session;
    }
}
