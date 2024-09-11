<?php

namespace Jericdei\PsgcDatabase;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Jericdei\PsgcDatabase\Commands\PsgcDatabaseCommand;

class PsgcDatabaseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('psgc-database')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_psgc_database_table')
            ->hasCommand(PsgcDatabaseCommand::class);
    }
}
