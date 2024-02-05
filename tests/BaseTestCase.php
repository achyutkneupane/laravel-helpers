<?php

namespace AchyutN\LaravelHelpers\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class BaseTestCase extends Orchestra
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();

        // test migrations
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->artisan('migrate', ['--database' => ':memory:'])->run();
    }

    protected function getEnvironmentSetUp($app): void
    {
        // sqlite test database
        $app['config']->set('database.connections.the_test', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        // set config
        $app['config']->set('database.default', 'the_test');
        $app['config']->set('test', 'test');
    }

    public function getPackageProviders($app): array
    {
        return [
            \AchyutN\LaravelHelpers\LaravelHelperProvider::class,
        ];
    }
}