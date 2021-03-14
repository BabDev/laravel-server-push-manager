# Upgrade from 1.x to 2.0

The below guide will assist in upgrading from the 1.x versions to 2.0.

## Bundle Requirements

- Laravel 8.12 or later
- PHP 8.0 or later

## General Changes

- Uses ^1.1.1 or ^2.0.1 of the PSR-13 specification, which requires PHP 8.0
- The `PushManager::link()` method's `$rel` param now supports a string or array of strings
