<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\QuickOrderPage;

use SprykerShop\Yves\ProductPackagingUnitWidget\Plugin\QuickOrder\QuickOrderItemDefaultPackagingUnitExpanderPlugin;
use SprykerShop\Yves\QuickOrderPage\Plugin\QuickOrder\QuickOrderFormMeasurementUnitColumnPlugin;
use SprykerShop\Yves\QuickOrderPage\Plugin\QuickOrderPage\ProductQuantityFilterPlugin;
use SprykerShop\Yves\QuickOrderPage\QuickOrderPageDependencyProvider as SprykerQuickOrderPageDependencyProvider;
use SprykerShop\Yves\ShoppingListWidget\Plugin\QuickOrderPage\ShoppingListQuickOrderFormHandlerStrategyPlugin;

class QuickOrderPageDependencyProvider extends SprykerQuickOrderPageDependencyProvider
{
    /**
     * @return \SprykerShop\Yves\QuickOrderPageExtension\Dependency\Plugin\QuickOrderItemExpanderPluginInterface[]
     */
    protected function getQuickOrderItemTransferExpanderPlugins(): array
    {
        return [
            new QuickOrderItemDefaultPackagingUnitExpanderPlugin(),
        ];
    }

    /**
     * @return \SprykerShop\Yves\QuickOrderPageExtension\Dependency\Plugin\QuickOrderFormHandlerStrategyPluginInterface[]
     */
    protected function getQuickOrderFormHandlerStrategyPlugins(): array
    {
        return [
            new ShoppingListQuickOrderFormHandlerStrategyPlugin(), #ShoppingListFeature
        ];
    }

    /**
     * @return \SprykerShop\Yves\QuickOrderPageExtension\Dependency\Plugin\QuickOrderFormColumnPluginInterface[]
     */
    protected function getQuickOrderFormColumnPlugins(): array
    {
        return [
            new QuickOrderFormMeasurementUnitColumnPlugin(),
        ];
    }

    /**
     * @return \SprykerShop\Yves\QuickOrderPageExtension\Dependency\Plugin\QuickOrderItemFilterPluginInterface[]
     */
    protected function getQuickOrderItemFilterPlugins(): array
    {
        return [
            new ProductQuantityFilterPlugin(),
        ];
    }
}
