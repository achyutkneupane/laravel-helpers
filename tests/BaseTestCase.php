<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\Routes\LatLongRoutes;
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
        $this->artisan('migrate')->run();

        LatLongRoutes::setupLatLongRoutes($this->app->get('router'));
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

        // sluggable config
        $app['config']->set('sluggable', [
            'source' => null,
            'onUpdate' => false,
            'separator' => '-',
            'method' => null,
            'maxLength' => null,
            'maxLengthKeepWords' => true,
            'unique' => true,
            'slugEngineOptions' => [],
            'reserved' => null,
            'includeTrashed' => false,
            'uniqueSuffix' => null,
            'firstUniqueSuffix' => 2,
        ]);
    }

    public function getPackageProviders($app): array
    {
        return [
            \AchyutN\LaravelHelpers\LaravelHelperProvider::class,
        ];
    }
}