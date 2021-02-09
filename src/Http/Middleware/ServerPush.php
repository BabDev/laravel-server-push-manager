<?php

namespace BabDev\ServerPushManager\Http\Middleware;

use BabDev\ServerPushManager\Http\HeaderSerializer;
use BabDev\ServerPushManager\PushManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Link\EvolvableLinkProviderInterface;

/**
 * Middleware which adds an HTTP/2 "Link" header to the response.
 */
final class ServerPush
{
    /**
     * @var PushManager
     */
    private $pushManager;

    /**
     * Instantiates the middleware.
     *
     * @param PushManager $pushManager
     */
    public function __construct(PushManager $pushManager)
    {
        $this->pushManager = $pushManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $response = $next($request);

        if ($response->isRedirection() || !$response instanceof Response || $request->isJson()) {
            return $response;
        }

        $linkProvider = $this->pushManager->getLinkProvider();

        if ($linkProvider instanceof EvolvableLinkProviderInterface && $links = $linkProvider->getLinks()) {
            $response->header('Link', (new HeaderSerializer())->serialize($links));
        }

        return $response;
    }
}
