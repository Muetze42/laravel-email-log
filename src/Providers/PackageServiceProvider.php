<?php

namespace NormanHuth\LaravelEmailLog\Providers;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use NormanHuth\LaravelEmailLog\Listeners\LogSentMessage;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/email-log.php', 'email-log');
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        Event::listen(MessageSent::class, LogSentMessage::class);

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->publishes([
            __DIR__.'/../../config/email-log.php' => config_path('email-log.php'),
        ], 'email-log-config');

        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'email-log-migrations');
    }
}
