<?php

namespace BabDev\ServerPushManager\Http\Middleware;

use BabDev\ServerPushManager\Http\HeaderSerializer;
use BabDev\ServerPushManager\PushManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Link\LinkProviderInterface;

/**
 * Middleware which adds an HTTP/2 "Link" header to the response.
 */
final class ServerPush
{
    /**
     * Instantiates the middleware.
     */
    public function __construct(
        private readonly PushManager $pushManager,
    ) {
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next): mixed
    {
        $response = $next($request);

        if ($response->isRedirection() || !$response instanceof Response || $request->isJson()) {
            return $response;
        }

        $linkProvider = $this->pushManager->getLinkProvider();

        if ($linkProvider instanceof LinkProviderInterface && $links = $linkProvider->getLinks()) {
            $response->header('Link', (new HeaderSerializer())->serialize($links));
        }

        return $response;
    }
}
