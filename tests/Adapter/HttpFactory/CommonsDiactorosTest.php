<?php

declare(strict_types=1);

namespace Tests\Adapter\HttpFactory;

use Iquety\Http\Adapter\HttpFactory\DiactorosHttpFactory;
use Iquety\Http\HttpFactory;

class CommonsDiactorosTest extends AbstractCommonsCase
{
    protected function makeFactory(): HttpFactory
    {
        return new DiactorosHttpFactory();
    }
}
