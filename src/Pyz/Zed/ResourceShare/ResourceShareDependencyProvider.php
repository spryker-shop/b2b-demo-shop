<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ResourceShare;

use Spryker\Zed\ResourceShare\ResourceShareDependencyProvider as SprykerResourceShareDependencyProvider;
use Spryker\Zed\SharedCart\Communication\Plugin\ResourceShare\ShareCartByResourceShareZedActivatorStrategyPlugin;

class ResourceShareDependencyProvider extends SprykerResourceShareDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ResourceShareExtension\Dependency\Plugin\ResourceShareZedActivatorStrategyPluginInterface>
     */
    protected function getResourceShareActivatorStrategyPlugins(): array
    {
        return [
            new ShareCartByResourceShareZedActivatorStrategyPlugin(),
        ];
    }
}
