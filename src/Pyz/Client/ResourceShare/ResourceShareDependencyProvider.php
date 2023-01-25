<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ResourceShare;

use Spryker\Client\ResourceShare\ResourceShareDependencyProvider as SprykerResourceShareDependencyProvider;
use Spryker\Client\SharedCart\Plugin\ResourceShare\CartShareLoginRequiredResourceShareClientActivatorStrategyPlugin;
use Spryker\Client\SharedCart\Plugin\ResourceShare\SwitchDefaultCartResourceShareClientActivatorStrategyPlugin;

class ResourceShareDependencyProvider extends SprykerResourceShareDependencyProvider
{
    /**
     * @return array<\Spryker\Client\ResourceShareExtension\Dependency\Plugin\ResourceShareClientActivatorStrategyPluginInterface>
     */
    protected function getBeforeZedResourceShareActivatorStrategyPlugins(): array
    {
        return [
            new CartShareLoginRequiredResourceShareClientActivatorStrategyPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\ResourceShareExtension\Dependency\Plugin\ResourceShareClientActivatorStrategyPluginInterface>
     */
    protected function getAfterZedResourceShareActivatorStrategyPlugins(): array
    {
        return [
            new SwitchDefaultCartResourceShareClientActivatorStrategyPlugin(),
        ];
    }
}
