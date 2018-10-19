<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage;

use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\CartToShoppingListWidget\Plugin\CartPage\CartToShoppingListWidgetPlugin;
use SprykerShop\Yves\CheckoutWidget\Plugin\CartPage\CheckoutBreadcrumbWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\CartPage\CartOperationsWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\CartPage\MultiCartListWidgetPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CartPage\ProductBundleCartItemTransformerPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CartPage\ProductBundleItemsWidgetPlugin;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Plugin\CartPage\QuantitySalesUnitWidgetPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\CartPage\CartItemProductOptionWidgetPlugin;
use SprykerShop\Yves\ProductPackagingUnitWidget\Plugin\CartPage\CartProductPackagingUnitWidgetPlugin;
use SprykerShop\Yves\SalesOrderThresholdWidget\Plugin\CartPage\SalesOrderThresholdWidgetPlugin;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{
    /**
     * @return array
     */
    protected function getCartPageWidgetPlugins(): array
    {
        return [
            CartItemProductOptionWidgetPlugin::class,
            CheckoutBreadcrumbWidgetPlugin::class,
            DiscountSummaryWidgetPlugin::class,
            ProductBundleItemsWidgetPlugin::class,
            QuantitySalesUnitWidgetPlugin::class,
            MultiCartListWidgetPlugin::class, #MultiCartFeature
            CartOperationsWidgetPlugin::class, #MultiCartFeature
            CartToShoppingListWidgetPlugin::class, #ShoppingListFeature
            CartProductPackagingUnitWidgetPlugin::class, #ProductPackagingUnit
            SalesOrderThresholdWidgetPlugin::class,
        ];
    }

    /**
     * @return \SprykerShop\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface[]
     */
    protected function getCartItemTransformerPlugins(): array
    {
        return [
            new ProductBundleCartItemTransformerPlugin(),
        ];
    }
}
