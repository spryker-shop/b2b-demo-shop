<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerReorderWidget;

use SprykerShop\Yves\CustomerReorderWidget\CustomerReorderWidgetDependencyProvider as SprykerShopCustomerReorderWidgetDependencyProvider;
use SprykerShop\Yves\SalesConfigurableBundleWidget\Plugin\CustomerReorder\ConfiguredBundlePostReorderPlugin;

class CustomerReorderWidgetDependencyProvider extends SprykerShopCustomerReorderWidgetDependencyProvider
{
    /**
     * @return \SprykerShop\Yves\CustomerReorderWidgetExtension\Dependency\Plugin\PostReorderPluginInterface[]
     */
    protected function getPostReorderPlugins(): array
    {
        return [
            new ConfiguredBundlePostReorderPlugin(),
        ];
    }
}
