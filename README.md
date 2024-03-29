# Server Push Manager for Laravel

[![Latest Stable Version](https://poser.pugx.org/babdev/laravel-server-push-manager/v/stable)](https://packagist.org/packages/babdev/laravel-server-push-manager) [![Latest Unstable Version](https://poser.pugx.org/babdev/laravel-server-push-manager/v/unstable)](https://packagist.org/packages/babdev/laravel-server-push-manager) [![Total Downloads](https://poser.pugx.org/babdev/laravel-server-push-manager/downloads)](https://packagist.org/packages/babdev/laravel-server-push-manager) [![License](https://poser.pugx.org/babdev/laravel-server-push-manager/license)](https://packagist.org/packages/babdev/laravel-server-push-manager) ![Run Tests](https://github.com/BabDev/laravel-server-push-manager/workflows/Run%20Tests/badge.svg?branch=1.x)

[Laravel](https://laravel.com) package adding a HTTP/2 server push manager to your Laravel applications.

## Why Another Package?

There are already other packages such as [jacobbennett/laravel-http2serverpush](https://github.com/JacobBennett/laravel-HTTP2ServerPush), [tomschlick/laravel-http2-server-push](https://github.com/tomschlick/laravel-http2-server-push), or [spatie/laravel-mix-preload](https://github.com/spatie/laravel-mix-preload), so why a new package?

Unlike other existing packages which are focused on automatically including resources, this package aims to provide an API to allow developers to configure server push headers for any resource with a maximum amount of flexibility. The API for this package is inspired by the [WebLinkExtension](https://github.com/symfony/twig-bridge/blob/master/Extension/WebLinkExtension.php) of Symfony's TwigBridge.

## Documentation

Please see the [BabDev website](https://www.babdev.com/open-source/packages/laravel-server-push-manager/docs/2.x/intro) for detailed information on how to use this package.

## Security

If you believe you have discovered a security issue with this package, please email michael.babker@gmail.com with information about the issue.  Do **NOT** use the public issue tracker for security issues.

## License

This package is licensed under the MIT License. See the [LICENSE file](/LICENSE) for full details.
