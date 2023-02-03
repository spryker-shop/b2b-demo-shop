<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ResourceSharePage;

use SprykerShop\Yves\PersistentCartSharePage\Plugin\ResourceSharePage\CartPreviewRouterStrategyPlugin;
use SprykerShop\Yves\ResourceSharePage\ResourceSharePageDependencyProvider as SprykerResourceSharePageDependencyProvider;
use SprykerShop\Yves\SharedCartPage\Plugin\ResourceShare\SharedCartRouterStrategyPlugin;

class ResourceSharePageDependencyProvider extends SprykerResourceSharePageDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\ResourceSharePageExtension\Dependency\Plugin\ResourceShareRouterStrategyPluginInterface>
     */
    protected function getResourceShareRouterStrategyPlugins(): array
    {
        return [
            new CartPreviewRouterStrategyPlugin(),
            new SharedCartRouterStrategyPlugin(),
        ];
    }
}
