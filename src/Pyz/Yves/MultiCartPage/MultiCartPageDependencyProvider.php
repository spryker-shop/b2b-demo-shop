<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\MultiCartPage;

use SprykerShop\Yves\MultiCartPage\MultiCartPageDependencyProvider as SprykerShopMultiCartPageDependencyProvider;
use SprykerShop\Yves\ProductBundleWidget\Plugin\MultiCartPage\ProductBundleItemCounterWidgetPlugin;
use SprykerShop\Yves\SharedCartWidget\Plugin\MultiCartPage\CartDeleteCompanyUsersListWidgetPlugin;
use SprykerShop\Yves\SharedCartWidget\Plugin\MultiCartPage\CartListPermissionGroupWidgetPlugin;
use SprykerShop\Yves\ShoppingListWidget\Plugin\MultiCartPage\CartToShoppingListWidgetPlugin;

class MultiCartPageDependencyProvider extends SprykerShopMultiCartPageDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getCartDeleteCompanyUsersListWidgetPlugins(): array
    {
        return [
            CartDeleteCompanyUsersListWidgetPlugin::class, #SharedCartFeature
        ];
    }

    /**
     * @return string[]
     */
    protected function getMultiCartListWidgetPlugins(): array
    {
        return [
            ProductBundleItemCounterWidgetPlugin::class, #ProductBundleFeature
            CartListPermissionGroupWidgetPlugin::class, #SharedCartFeature
            CartToShoppingListWidgetPlugin::class, #ShoppingListFeature
        ];
    }
}
