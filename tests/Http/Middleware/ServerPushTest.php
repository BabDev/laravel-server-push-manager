<?php

namespace BabDev\ServerPushManager\Tests\Http\Middleware;

use BabDev\ServerPushManager\Http\Middleware\ServerPush;
use BabDev\ServerPushManager\PushManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

final class ServerPushTest extends TestCase
{
    /**
     * @var PushManager
     */
    private $pushManager;

    /**
     * @var ServerPush
     */
    private $middleware;

    protected function setUp(): void
    {
        $this->pushManager = new PushManager();

        $this->middleware = new ServerPush($this->pushManager);
    }

    public function testNoLinkHeaderIsAddedIfThereAreNoPushedResources(): void
    {
        $next = static fn () => new Response();

        $request = new Request();

        /** @var Response $response */
        $response = $this->middleware->handle($request, $next);

        $this->assertFalse($response->headers->has('Link'));
    }

    public function testNoLinkHeaderIsAddedIfTheResponseIsARedirect(): void
    {
        $next = static fn () => new RedirectResponse('http://localhost', 301);

        $request = new Request();

        /** @var Response $response */
        $response = $this->middleware->handle($request, $next);

        $this->assertFalse($response->headers->has('Link'));
    }

    public function testALinkHeaderIsAddedForPushedResources(): void
    {
        $next = function (): Response {
            $this->pushManager->preload('/css/app.css', ['nopush' => false]);
            $this->pushManager->preload('/css/style.css', ['nopush' => true]);
            $this->pushManager->link('/blog/page/2', 'next', ['hreflang' => ['fr', 'de']]);

            return new Response();
        };

        $request = new Request();

        /** @var Response $response */
        $response = $this->middleware->handle($request, $next);

        $this->assertTrue($response->headers->has('Link'));
        $this->assertSame(
            '</css/app.css>; rel="preload",</css/style.css>; rel="preload"; nopush,</blog/page/2>; rel="next"; hreflang="fr"; hreflang="de"',
            $response->headers->get('Link')
        );
    }
}
