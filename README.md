# Server Push Manager for Laravel [![Build Status](https://travis-ci.com/BabDev/laravel-server-push-manager.svg?branch=master)](https://travis-ci.com/BabDev/laravel-server-push-manager)

Laravel package adding a HTTP/2 server push manager to your Laravel applications.

## Why Another Package?

There are already other packages such as [jacobbennett/laravel-http2serverpush](https://github.com/JacobBennett/laravel-HTTP2ServerPush), [tomschlick/laravel-http2-server-push](https://github.com/tomschlick/laravel-http2-server-push), or [spatie/laravel-mix-preload](https://github.com/spatie/laravel-mix-preload), so why a new package?

Unlike other existing packages which are focused on automatically including resources, this package aims to provide an API to allow developers to configure server push headers for any resource with a maximum amount of flexibility. The API for this package is inspired by the [WebLinkExtension](https://github.com/symfony/twig-bridge/blob/master/Extension/WebLinkExtension.php) of Symfony's TwigBridge.

## License

This package is licensed under the MIT License. See the [LICENSE file](/LICENSE) for full details.
