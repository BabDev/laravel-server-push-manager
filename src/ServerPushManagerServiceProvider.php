<?php

namespace BabDev\ServerPushManager;

use Illuminate\Support\ServiceProvider;

final class ServerPushManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            'babdev.push_manager',
            function () {
                return new PushManager();
            }
        );

        $this->app->alias('babdev.push_manager', PushManager::class);
    }
}
