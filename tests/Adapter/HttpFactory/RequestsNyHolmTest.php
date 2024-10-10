<?php

declare(strict_types=1);

namespace Tests\Adapter\HttpFactory;

use Iquety\Http\Adapter\HttpFactory\NyHolmHttpFactory;
use Iquety\Http\HttpFactory;

class RequestsNyHolmTest extends AbstractRequestsCase
{
    protected function makeFactory(): HttpFactory
    {
        return new NyHolmHttpFactory();
    }
}
