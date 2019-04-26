# Server Push Manager for Laravel

Laravel package adding a HTTP/2 server push manager to your Laravel applications.

## Installation

To install this package, run the following [Composer](https://getcomposer.org/) command:

```sh
composer require babdev/laravel-server-push-manager
```

If your application is not using package discovery, you will need to add the service provider to your `config/app.php` file:

```sh
\BabDev\ServerPushManager\ServerPushManagerServiceProvider::class,
```

## Usage

Coming soon...

## Why Another Package?

There are already other packages such as [jacobbennett/laravel-http2serverpush](https://github.com/JacobBennett/laravel-HTTP2ServerPush), [tomschlick/laravel-http2-server-push](https://github.com/tomschlick/laravel-http2-server-push), or [spatie/laravel-mix-preload](https://github.com/spatie/laravel-mix-preload), so why a new package?

Unlike other existing packages which are focused on automatically including resources, this package aims to provide an API to allow developers to configure server push headers for any resource with a maximum amount of flexibility.  The API for this package is inspired by the [WebLinkExtension](https://github.com/symfony/twig-bridge/blob/master/Extension/WebLinkExtension.php) of Symfony's TwigBridge, which was also the basis for the [Joomla! Framework Preload Package](https://github.com/joomla-framework/preload).
