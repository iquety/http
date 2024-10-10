<?php

declare(strict_types=1);

namespace Tests;

use Iquety\Application;
use Iquety\Injection\Container;
use PHPUnit\Framework\TestCase as FrameworkTestCase;
use Tests\Support\EngineFactories;
use Tests\Support\HttpFactories;
use Tests\Support\ModuleFactories;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class TestCase extends FrameworkTestCase
{
}
