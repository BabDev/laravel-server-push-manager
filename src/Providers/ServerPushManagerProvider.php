<?php

namespace BabDev\ServerPushManager\Providers;

use BabDev\ServerPushManager\Contracts\PushManager as PushManagerContract;
use BabDev\ServerPushManager\PushManager;
use Illuminate\Support\ServiceProvider;

final class ServerPushManagerProvider extends ServiceProvider
{
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
