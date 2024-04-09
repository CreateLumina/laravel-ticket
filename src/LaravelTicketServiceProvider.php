<?php

namespace Lumina\Tickets;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTicketServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('tickets')
            ->hasConfigFile('laravel_ticket')
            ->hasMigrations(
                'create_tickets_table',
                'create_messages_table',
                'create_categories_table',
                'create_category_ticket_table',
            );
    }
}
