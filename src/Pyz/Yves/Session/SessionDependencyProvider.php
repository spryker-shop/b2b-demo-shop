<?php



declare(strict_types = 1);

namespace Pyz\Yves\Session;

use Spryker\Yves\Session\SessionDependencyProvider as SprykerSessionDependencyProvider;
use Spryker\Yves\SessionFile\Plugin\Session\SessionHandlerFileProviderPlugin;
use Spryker\Yves\SessionRedis\Plugin\Session\SessionHandlerRedisLockingProviderPlugin;
use Spryker\Yves\SessionRedis\Plugin\Session\SessionHandlerRedisProviderPlugin;

class SessionDependencyProvider extends SprykerSessionDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\SessionExtension\Dependency\Plugin\SessionHandlerProviderPluginInterface>
     */
    protected function getSessionHandlerPlugins(): array
    {
        return [
            new SessionHandlerRedisProviderPlugin(),
            new SessionHandlerRedisLockingProviderPlugin(),
            new SessionHandlerFileProviderPlugin(),
        ];
    }
}
