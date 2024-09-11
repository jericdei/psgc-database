<?php

namespace Jericdei\PsgcDatabase;

use Jericdei\PsgcDatabase\Commands\DownloadPsgcLatestDataCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigrations(
                'create_regions_table',
                'create_provinces_table',
                'create_municipalities_table',
                'create_sub_municipalities_table',
                'create_barangays_table',
                'create_cities_table',
            )
            ->hasCommands(
                DownloadPsgcLatestDataCommand::class,
            );
    }
}
