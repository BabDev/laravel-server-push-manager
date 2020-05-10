# Installation & Setup

To install this package, run the following [Composer](https://getcomposer.org/) command:

```bash
composer require babdev/laravel-server-push-manager
```

## Register The Package

If your application is not using package discovery, you will need to add the service provider to your `config/app.php` file.

```php
return [
    'providers' => [
        BabDev\ServerPushManager\Providers\ServerPushManagerProvider::class,
    ],
];
```

To use the facade, you will also need to register it in your `config/app.php` file.

```php
return [
    'aliases' => [
        'PushManager' => BabDev\ServerPushManager\Facades\PushManager::class,
    ],
];
```

## Add Middleware

To automatically send the correct header from the resources added to the manager, you will need to register `BabDev\ServerPushManager\Http\Middleware\ServerPush` as a middleware in your kernel. It is recommended to add it to only groups which handle web traffic with pushed assets, such as the default "web" group:

```php
<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // ..
            \BabDev\ServerPushManager\Http\Middleware\ServerPush::class,
        ],
    ];
}
```
