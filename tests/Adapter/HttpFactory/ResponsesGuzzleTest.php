<?php

declare(strict_types=1);

namespace Tests\Adapter\HttpFactory;

use Iquety\Http\Adapter\HttpFactory\GuzzleHttpFactory;
use Iquety\Http\HttpFactory;

class ResponsesGuzzleTest extends AbstractResponsesCase
{
    protected function makeFactory(): HttpFactory
    {
        return new GuzzleHttpFactory();
    }
}
