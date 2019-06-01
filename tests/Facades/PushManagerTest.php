<?php

namespace BabDev\ServerPushManager\Tests\Facades;

use BabDev\ServerPushManager\Facades\PushManager as PushManagerFacade;
use BabDev\ServerPushManager\Providers\ServerPushManagerProvider;
use Fig\Link\Link;
use Orchestra\Testbench\TestCase;

final class PushManagerTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServerPushManagerProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PushManager' => PushManagerFacade::class,
        ];
    }

    /**
     * @testdox  A Link header for the specified relations is added
     */
    public function testLink(): void
    {
        \PushManager::link('/foo.css', 'preload prefetch', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preload prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values(\PushManager::getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the preload relation is added
     */
    public function testPreload(): void
    {
        \PushManager::preload('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preload', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values(\PushManager::getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the dns-prefetch relation is added
     */
    public function testDnsPrefetch(): void
    {
        \PushManager::dnsPrefetch('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('dns-prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values(\PushManager::getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the preconnect relation is added
     */
    public function testPreconnect(): void
    {
        \PushManager::preconnect('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preconnect', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values(\PushManager::getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the prefetch relation is added
     */
    public function testPrefetch(): void
    {
        \PushManager::prefetch('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values(\PushManager::getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the prerender relation is added
     */
    public function testPrerender(): void
    {
        \PushManager::prerender('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('prerender', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values(\PushManager::getLinkProvider()->getLinks()));
    }
}