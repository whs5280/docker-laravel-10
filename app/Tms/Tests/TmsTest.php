<?php

namespace App\Tms\Tests;
use App\Tms\Container\TmsContainer;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase;

class TmsTest extends TestCase
{
    public function sortId(): string
    {
        // TODO: Implement sortId() method.
    }

    public function provides(): array
    {
        // TODO: Implement provides() method.
    }

    public function requires(): array
    {
        // TODO: Implement requires() method.
    }

    public function run(): void
    {
        // TODO: Implement run() method.
    }

    public function createApplication()
    {
        // TODO: Implement createApplication() method.
    }

    public function testTms()
    {
        $container = TmsContainer::getInstance();

        $this->assertEquals(Carbon::now()->toDateTimeString(), $container->getData());
        $this->assertEquals(1, $container->check('mock'));
        $this->assertEquals(0, $container->check('其他'));
    }
}
