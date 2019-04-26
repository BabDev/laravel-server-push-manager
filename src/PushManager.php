<?php

namespace BabDev\ServerPushManager;

use Fig\Link\GenericLinkProvider;
use Fig\Link\Link;
use Psr\Link\EvolvableLinkProviderInterface;

final class PushManager
{
    /**
     * @var EvolvableLinkProviderInterface
     */
    private $linkProvider;

    public function __construct(?EvolvableLinkProviderInterface $linkProvider = null)
    {
        $this->linkProvider = $linkProvider ?: new GenericLinkProvider();
    }

    public function getLinkProvider(): EvolvableLinkProviderInterface
    {
        return $this->linkProvider;
    }

    public function setLinkProvider(EvolvableLinkProviderInterface $linkProvider): void
    {
        $this->linkProvider = $linkProvider;
    }

    /**
     * Adds a "Link" HTTP header for a resource.
     *
     * @param string $uri        The relation URI
     * @param string $rel        The relation type (e.g. "preload", "prefetch", "prerender" or "dns-prefetch")
     * @param array  $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     */
    public function link(string $uri, string $rel, array $attributes = []): void
    {
        $link = new Link($rel, $uri);

        foreach ($attributes as $key => $value) {
            $link = $link->withAttribute($key, $value);
        }

        $this->setLinkProvider($this->getLinkProvider()->withLink($link));
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "preload" relation.
     *
     * @param string $uri        The relation URI
     * @param array  $attributes The attributes of this link (e.g. "array('as' => true)", "array('crossorigin' => 'use-credentials')")
     */
    public function preload(string $uri, array $attributes = []): void
    {
        $this->link($uri, 'preload', $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "dns-prefetch" relation.
     *
     * @param string $uri        The relation URI
     * @param array  $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     */
    public function dnsPrefetch(string $uri, array $attributes = []): void
    {
        $this->link($uri, 'dns-prefetch', $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "preconnect" relation.
     *
     * @param string $uri        The relation URI
     * @param array  $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     */
    public function preconnect(string $uri, array $attributes = []): void
    {
        $this->link($uri, 'preconnect', $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "prefetch" relation.
     *
     * @param string $uri        The relation URI
     * @param array  $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     */
    public function prefetch(string $uri, array $attributes = []): void
    {
        $this->link($uri, 'prefetch', $attributes);
    }

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "prerender" relation.
     *
     * @param string $uri        The relation URI
     * @param array  $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     */
    public function prerender(string $uri, array $attributes = []): void
    {
        $this->link($uri, 'prerender', $attributes);
    }
}
