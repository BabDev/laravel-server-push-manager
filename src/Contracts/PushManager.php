<?php

namespace BabDev\ServerPushManager\Contracts;

use Psr\Link\EvolvableLinkProviderInterface;

interface PushManager
{
    /**
     * Retrieve the link provider for the manager.
     */
    public function getLinkProvider(): EvolvableLinkProviderInterface;

    /**
     * Replace the link provider within the manager.
     */
    public function setLinkProvider(EvolvableLinkProviderInterface $linkProvider): void;

    /**
     * Adds a "Link" HTTP header for a resource.
     *
     * @param string                $uri        The relation URI
     * @param string|string[]       $rel        The relation type(s) (e.g. "preload", "prefetch", "prerender" or "dns-prefetch")
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function link(string $uri, string|array $rel, array $attributes = []): string;

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "preload" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function preload(string $uri, array $attributes = []): string;

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "dns-prefetch" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function dnsPrefetch(string $uri, array $attributes = []): string;

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "preconnect" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function preconnect(string $uri, array $attributes = []): string;

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "prefetch" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function prefetch(string $uri, array $attributes = []): string;

    /**
     * Shortcut to add a "Link" HTTP header for a resource with the "prerender" relation.
     *
     * @param string                $uri        The relation URI
     * @param array<string, string> $attributes The attributes of this link (e.g. "array('as' => true)", "array('pr' => 0.5)")
     *
     * @return string The `$uri` originally passed into this method
     */
    public function prerender(string $uri, array $attributes = []): string;
}
