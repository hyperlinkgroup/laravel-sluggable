<?php

namespace Hyperlink\Sluggable\Tests;

use Hyperlink\Sluggable\SluggableServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            static fn (string $modelName) => 'Hyperlink\\Sluggable\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->artisan('migrate');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }

    protected function getPackageProviders($app): array
    {
        return [
            SluggableServiceProvider::class,
            TestServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $migration = include __DIR__.'/../database/migrations/create_sluggable_table.php.stub';
        $migration->up();
    }
}
