<?php

namespace BabDev\ServerPushManager;

use Illuminate\Support\Facades\Facade;
use Psr\Link\EvolvableLinkProviderInterface;

/**
 * @method static EvolvableLinkProviderInterface getLinkProvider()
 * @method static void setLinkProvider(EvolvableLinkProviderInterface $linkProvider)
 * @method static void link(string $uri, string $rel, array $attributes = [])
 * @method static void preload(string $uri, array $attributes = [])
 * @method static void dnsPrefetch(string $uri, array $attributes = [])
 * @method static void preconnect(string $uri, array $attributes = [])
 * @method static void prefetch(string $uri, array $attributes = [])
 * @method static void prerender(string $uri, array $attributes = [])
 *
 * @see \BabDev\ServerPushManager\PushManager
 */
final class PushManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'babdev.push_manager';
    }
}
