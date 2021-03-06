<?php

namespace BabDev\ServerPushManager\Providers;

use BabDev\ServerPushManager\Contracts\PushManager as PushManagerContract;
use BabDev\ServerPushManager\PushManager;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class ServerPushManagerProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            'babdev.push_manager',
            PushManager::class,
            PushManagerContract::class,
        ];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            'babdev.push_manager',
            static fn () => new PushManager(),
        );

        $this->app->alias('babdev.push_manager', PushManager::class);
        $this->app->alias('babdev.push_manager', PushManagerContract::class);
    }
}
