<?php

namespace BabDev\ServerPushManager;

use BabDev\ServerPushManager\Contracts\PushManager as PushManagerContract;
use Fig\Link\GenericLinkProvider;
use Fig\Link\Link;
use Fig\Link\Relations;
use Psr\Link\EvolvableLinkProviderInterface;

final class PushManager implements PushManagerContract
{
    private EvolvableLinkProviderInterface $linkProvider;

    /**
     * Instantiates the manager.
     */
    public function __construct(?EvolvableLinkProviderInterface $linkProvider = null)
    {
        $this->linkProvider = $linkProvider ?: new GenericLinkProvider();
    }

    /**
     * Retrieve the link provider for the manager.
     */
    public function getLinkProvider(): EvolvableLinkProviderInterface
    {
        return $this->linkProvider;
    }

    /**
     * Replace the link provider within the manager.
     */
    public function setLinkProvider(EvolvableLinkProviderInterface $linkProvider): void
    {
        $this->linkProvider = $linkProvider;
    }

    /**
     * Adds a "Link" HTTP header for a resource.
     *
     * @param string                $uri        The relation URI
     * @param string|string[]       $rel        The relation type(s) (e.g. "preload", "prefetch", "prerender" or "dns-prefetch")
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function link(string $uri, string|array $rel, array $attributes = []): string
    {
        $link = new Link('', $uri);

        if (\is_string($rel)) {
            $rel = [$rel];
        }

        foreach ($rel as $value) {
            $link = $link->withRel($value);
        }

        foreach ($attributes as $key => $value) {
            $link = $link->withAttribute($key, $value);
        }

        $this->setLinkProvider($this->getLinkProvider()->withLink($link));

        return $uri;
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "preload" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function preload(string $uri, array $attributes = []): string
    {
        return $this->link($uri, Relations::REL_PRELOAD, $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "dns-prefetch" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function dnsPrefetch(string $uri, array $attributes = []): string
    {
        return $this->link($uri, Relations::REL_DNS_PREFETCH, $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "preconnect" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function preconnect(string $uri, array $attributes = []): string
    {
        return $this->link($uri, Relations::REL_PRECONNECT, $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "prefetch" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function prefetch(string $uri, array $attributes = []): string
    {
        return $this->link($uri, Relations::REL_PREFETCH, $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "prerender" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function prerender(string $uri, array $attributes = []): string
    {
        return $this->link($uri, Relations::REL_PRERENDER, $attributes);
    }
}
