<?php

namespace BabDev\ServerPushManager\Tests;

use BabDev\ServerPushManager\PushManager;
use BabDev\ServerPushManager\ServerPushManagerServiceProvider;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

final class ServerPushManagerServiceProviderTest extends TestCase
{
    public function testServiceIsRegistered(): void
    {
        $container = new Container();

        (new ServerPushManagerServiceProvider($container))->register();

        $this->assertTrue($container->bound('babdev.push_manager'));
        $this->assertSame('babdev.push_manager', $container->getAlias(PushManager::class));
    }
}
