<?php

namespace BabDev\ServerPushManager\Tests;

use BabDev\ServerPushManager\PushManager;
use Fig\Link\Link;
use PHPUnit\Framework\TestCase;

final class PushManagerTest extends TestCase
{
    /**
     * @var PushManager
     */
    private $object;

    protected function setUp(): void
    {
        $this->object = new PushManager();
    }

    /**
     * @testdox  A Link header for the specified relations is added
     */
    public function testLink(): void
    {
        $this->object->link('/foo.css', 'preload prefetch', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preload prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values($this->object->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the preload relation is added
     */
    public function testPreload(): void
    {
        $this->object->preload('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preload', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values($this->object->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the dns-prefetch relation is added
     */
    public function testDnsPrefetch(): void
    {
        $this->object->dnsPrefetch('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('dns-prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values($this->object->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the preconnect relation is added
     */
    public function testPreconnect(): void
    {
        $this->object->preconnect('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('preconnect', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values($this->object->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the prefetch relation is added
     */
    public function testPrefetch(): void
    {
        $this->object->prefetch('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('prefetch', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values($this->object->getLinkProvider()->getLinks()));
    }

    /**
     * @testdox  A Link header for the prerender relation is added
     */
    public function testPrerender(): void
    {
        $this->object->prerender('/foo.css', ['as' => 'style', 'crossorigin' => true]);

        $link = (new Link('prerender', '/foo.css'))->withAttribute('as', 'style')->withAttribute('crossorigin', true);

        $this->assertEquals([$link], \array_values($this->object->getLinkProvider()->getLinks()));
    }
}
