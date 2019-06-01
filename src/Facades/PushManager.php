<?php

namespace BabDev\ServerPushManager\Facades;

use Illuminate\Support\Facades\Facade;
use Psr\Link\EvolvableLinkProviderInterface;

/**
 * @method static EvolvableLinkProviderInterface getLinkProvider()
 * @method static void setLinkProvider(EvolvableLinkProviderInterface $linkProvider)
 * @method static string link(string $uri, string $rel, array $attributes = [])
 * @method static string preload(string $uri, array $attributes = [])
 * @method static string dnsPrefetch(string $uri, array $attributes = [])
 * @method static string preconnect(string $uri, array $attributes = [])
 * @method static string prefetch(string $uri, array $attributes = [])
 * @method static string prerender(string $uri, array $attributes = [])
 *
 * @see \BabDev\ServerPushManager\PushManager
 */
final class PushManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'babdev.push_manager';
    }
}
