<?php

namespace Hyperlink\Sluggable\Tests;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class TestServiceProvider extends BaseServiceProvider
{
    protected bool $defer = false;

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/database/migrations'
        );
    }
}
