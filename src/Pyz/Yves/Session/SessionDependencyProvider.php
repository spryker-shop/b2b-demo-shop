<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\Session;

use Spryker\Yves\Session\SessionDependencyProvider as SprykerSessionDependencyProvider;
use Spryker\Yves\SessionFile\Plugin\Session\SessionHandlerFileProviderPlugin;
use Spryker\Yves\SessionRedis\Plugin\Session\SessionHandlerConfigurableRedisLockingProviderPlugin;
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
            new SessionHandlerFileProviderPlugin(),
            new SessionHandlerConfigurableRedisLockingProviderPlugin(),
        ];
    }
}
