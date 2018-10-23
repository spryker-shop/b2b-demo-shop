<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage;

use SprykerShop\Yves\CartNoteWidget\Plugin\CartPage\CartNoteQuoteItemWidgetPlugin;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\CheckoutWidget\Plugin\CartPage\CheckoutBreadcrumbWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\CartPage\CartOperationsWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\CartPage\MultiCartListWidgetPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CartPage\ProductBundleCartItemTransformerPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CartPage\ProductBundleItemsWidgetPlugin;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Plugin\CartPage\QuantitySalesUnitWidgetPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\CartPage\CartItemProductOptionWidgetPlugin;
use SprykerShop\Yves\ProductPackagingUnitWidget\Plugin\CartPage\CartProductPackagingUnitWidgetPlugin;

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
            ProductBundleItemsWidgetPlugin::class,
            QuantitySalesUnitWidgetPlugin::class,
            CartNoteQuoteItemWidgetPlugin::class, #CartNoteFeature
            MultiCartListWidgetPlugin::class, #MultiCartFeature
            CartOperationsWidgetPlugin::class, #MultiCartFeature
            CartProductPackagingUnitWidgetPlugin::class, #ProductPackagingUnit
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
