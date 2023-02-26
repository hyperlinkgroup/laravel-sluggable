<?php

namespace Hyperlink\Sluggable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SluggableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-sluggable')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_sluggable_table');
    }
}
