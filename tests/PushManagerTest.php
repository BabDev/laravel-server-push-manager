<?php

namespace BabDev\ServerPushManager\Tests;

use BabDev\ServerPushManager\PushManager;
use Fig\Link\Link;
use PHPUnit\Framework\TestCase;

final class PushManagerTest extends TestCase
{
    private PushManager $manager;

    protected function setUp(): void
    {
        $this->manager = new PushManager();
    }

    /**
     * @testdox  A Link header for the specified relations as a string is added
     */
    public function testLinkWithStringRelations(): void
    {
        $this->manager->link('/foo.css', 'preload', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preload', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], array_values($this->manager->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the specified relations as an array is added
     */
    public function testLinkWithArrayRelations(): void
    {
        $this->manager->link('/foo.css', ['preload', 'prefetch'], ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('', '/foo.css'))->withRel('preload')->withRel('prefetch')->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], array_values($this->manager->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the preload relation is added
     */
    public function testPreload(): void
    {
        $this->manager->preload('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preload', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], array_values($this->manager->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the dns-prefetch relation is added
     */
    public function testDnsPrefetch(): void
    {
        $this->manager->dnsPrefetch('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('dns-prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], array_values($this->manager->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the preconnect relation is added
     */
    public function testPreconnect(): void
    {
        $this->manager->preconnect('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preconnect', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], array_values($this->manager->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the prefetch relation is added
     */
    public function testPrefetch(): void
    {
        $this->manager->prefetch('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], array_values($this->manager->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the prerender relation is added
     */
    public function testPrerender(): void
    {
        $this->manager->prerender('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('prerender', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], array_values($this->manager->getLinkProvider()->getLinks()));
    }
}
