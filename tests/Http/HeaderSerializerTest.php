<?php

namespace BabDev\ServerPushManager\Tests\Http;

use BabDev\ServerPushManager\Http\HeaderSerializer;
use Fig\Link\Link;
use PHPUnit\Framework\TestCase;

final class HeaderSerializerTest extends TestCase
{
    private HeaderSerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new HeaderSerializer();
    }

    public function testSerialize(): void
    {
        $links = [
            new Link('prerender', '/1'),
            (new Link('dns-prefetch', '/2'))->withAttribute('pr', 0.7),
            (new Link('preload', '/3'))->withAttribute('as', 'script')->withAttribute('nopush', false),
            (new Link('preload', '/4'))->withAttribute('as', 'image')->withAttribute('nopush', true),
            (new Link('alternate', '/5'))->withRel('next')->withAttribute('hreflang', ['fr', 'de'])->withAttribute('title', 'Hello'),
        ];

        $this->assertEquals('</1>; rel="prerender",</2>; rel="dns-prefetch"; pr="0.7",</3>; rel="preload"; as="script",</4>; rel="preload"; as="image"; nopush,</5>; rel="alternate next"; hreflang="fr"; hreflang="de"; title="Hello"', $this->serializer->serialize($links));
    }

    public function testSerializeEmpty(): void
    {
        $this->assertNull($this->serializer->serialize([]));
    }
}
