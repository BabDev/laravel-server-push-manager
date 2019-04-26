<?php

namespace BabDev\ServerPushManager\Tests;

use BabDev\ServerPushManager\PushManager;
use BabDev\ServerPushManager\ServerPushMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

final class ServerPushMiddlewareTest extends TestCase
{
    /**
     * @var PushManager
     */
    private $pushManager;

    /**
     * @var ServerPushMiddleware
     */
    private $middleware;

    protected function setUp(): void
    {
        $this->pushManager = new PushManager();

        $this->middleware = new ServerPushMiddleware($this->pushManager);
    }

    public function testNoLinkHeaderIsAddedIfThereAreNoPushedResources(): void
    {
        $next = function () {
            return new Response();
        };

        $request = new Request();

        /** @var Response $response */
        $response = $this->middleware->handle($request, $next);

        $this->assertFalse($response->headers->has('Link'));
    }

    public function testALinkHeaderIsAddedForPushedResources(): void
    {
        $next = function () {
            $this->pushManager->preload('/css/app.css');

            return new Response();
        };

        $request = new Request();

        /** @var Response $response */
        $response = $this->middleware->handle($request, $next);

        $this->assertTrue($response->headers->has('Link'));
    }
}
