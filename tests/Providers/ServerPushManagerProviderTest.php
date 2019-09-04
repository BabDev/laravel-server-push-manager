<?php

namespace BabDev\ServerPushManager\Tests\Providers;

use BabDev\ServerPushManager\Contracts\PushManager as PushManagerContract;
use BabDev\ServerPushManager\Providers\ServerPushManagerProvider;
use BabDev\ServerPushManager\PushManager;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

final class ServerPushManagerProviderTest extends TestCase
{
    public function testServiceIsRegistered(): void
    {
        $container = new Container();

        (new ServerPushManagerProvider($container))->register();

        $this->assertTrue($container->bound('babdev.push_manager'));
        $this->assertSame('babdev.push_manager', $container->getAlias(PushManager::class));
        $this->assertSame('babdev.push_manager', $container->getAlias(PushManagerContract::class));
    }
}
