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
     *
     * @return array
     */
    public function provides()
    {
        return [
            'babdev.push_manager',
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'babdev.push_manager',
            function () {
                return new PushManager();
            }
        );

        $this->app->alias('babdev.push_manager', PushManager::class);
        $this->app->alias('babdev.push_manager', PushManagerContract::class);
    }
}
