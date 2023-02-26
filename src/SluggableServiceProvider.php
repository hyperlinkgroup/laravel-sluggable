<?php

namespace Hyperlink\Sluggable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Hyperlink\Sluggable\Commands\SluggableCommand;

class SluggableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-sluggable')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-sluggable_table')
            ->hasCommand(SluggableCommand::class);
    }
}
