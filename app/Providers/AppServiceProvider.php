<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Shared\Domain\Bus\Command\CommandBus;
use Src\Shared\Infrastructure\Bus\CommandBusImp;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CommandBus::class,
            function ($app) {
                return new CommandBusImp($app->tagged('command_handler'));
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
