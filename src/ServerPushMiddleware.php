<?php

namespace BabDev\ServerPushManager;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Link\EvolvableLinkProviderInterface;
use Symfony\Component\WebLink\HttpHeaderSerializer;

final class ServerPushMiddleware
{
    /**
     * @var PushManager
     */
    private $pushManager;

    public function __construct(PushManager $pushManager)
    {
        $this->pushManager = $pushManager;
    }

    public function handle(Request $request, \Closure $next)
    {
        $response = $next($request);

        if ($response->isRedirection() || !$response instanceof Response || $request->isJson()) {
            return $response;
        }

        $linkProvider = $this->pushManager->getLinkProvider();

        if ($linkProvider instanceof EvolvableLinkProviderInterface && $links = $linkProvider->getLinks()) {
            $response->header('Link', (new HttpHeaderSerializer)->serialize($links));
        }

        return $response;
    }
}
