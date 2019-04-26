# Server Push Manager for Laravel

Laravel package adding a HTTP/2 server push manager to your Laravel applications.

## Installation

To install this package, run the following [Composer](https://getcomposer.org/) command:

```sh
composer require babdev/laravel-server-push-manager
```

If your application is not using package discovery, you will need to add the service provider to your `config/app.php` file:

```sh
BabDev\ServerPushManager\ServerPushManagerServiceProvider::class,
```

Likewise, you will also need to register the facade in your `config/app.php` file if not using package discovery:

```sh
'PushManager' => BabDev\ServerPushManager\PushManagerFacade::class,
``` 

To send the header, you will need to register `BabDev\ServerPushManager\ServerPushMiddleware` as a middleware in your kernel. It is recommended to add it to only groups which handle web traffic with pushed assets, such as the default "web" group:

```php
// app/Http/Kernel.php

protected $middlewareGroups = [
    'web' => [
        \BabDev\ServerPushManager\ServerPushMiddleware::class,
    ],
];
```

## Usage

### Within Blade Templates

You can specify which assets should have a server push directive directly within your Blade templates by calling the `PushManager` service. Because the `PushManager` returns the original URI, you can wrap calls to `asset()` or `mix()` with a call to the manager. Note, the below example requires the `PushManagerFacade` have been registered in your application.

```php
<link href="{{ PushManager::preload(mix('css/app.css'), ['as' => 'stylesheet']) }}" rel="stylesheet">
<script src="{{ PushManager::preload(asset('js/app.js'), ['as' => 'script']) }}"></script>
```

### Within PHP classes

You can access the `PushManager` service by injecting it as a dependency to your class or controller action, through the `app()` helper using the service ID ('babdev.push_manager') or the class name, or using the facade.

```php
namespace App\Http\Controllers;

use BabDev\ServerPushManager\PushManager;
use Illuminate\Http\Request;

class MyController extends Controller;
{
    private $pushManager;

    public function __construct(PushManager $pushManager)
    {
        $this->pushManager = $pushManager;
    }

    public function myConstructorAction()
    {
        $this->pushManager->preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);
    }

    public function myInjectedAction(Request $request, PushManager $pushManager)
    {
        $pushManager->preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);
    }

    public function myAppAction()
    {
        /** @var PushManager $pushManager */
        $pushManager = app('babdev.push_manager');
        $pushManager->preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);
    }

    public function myFacadeAction()
    {
        \PushManager::preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);
    }
}
```

## Why Another Package?

There are already other packages such as [jacobbennett/laravel-http2serverpush](https://github.com/JacobBennett/laravel-HTTP2ServerPush), [tomschlick/laravel-http2-server-push](https://github.com/tomschlick/laravel-http2-server-push), or [spatie/laravel-mix-preload](https://github.com/spatie/laravel-mix-preload), so why a new package?

Unlike other existing packages which are focused on automatically including resources, this package aims to provide an API to allow developers to configure server push headers for any resource with a maximum amount of flexibility.  The API for this package is inspired by the [WebLinkExtension](https://github.com/symfony/twig-bridge/blob/master/Extension/WebLinkExtension.php) of Symfony's TwigBridge, which was also the basis for the [Joomla! Framework Preload Package](https://github.com/joomla-framework/preload).
