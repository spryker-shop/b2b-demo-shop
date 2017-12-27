<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage;

use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface;
use SprykerShop\Yves\CheckoutWidget\Plugin\CartPage\CheckoutBreadcrumbWidgetPlugin;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\CartPage\DiscountPromotionItemListWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountVoucherFormWidgetPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CartPage\ProductBundleCartItemTransformerPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CartPage\ProductBundleItemsWidgetPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\CartPage\CartItemProductOptionWidgetPlugin;
use SprykerShop\Yves\ProductRelationWidget\Plugin\CartPage\UpSellingProductsWidgetPlugin;

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
            DiscountVoucherFormWidgetPlugin::class,
            DiscountSummaryWidgetPlugin::class,
            DiscountPromotionItemListWidgetPlugin::class,
            UpSellingProductsWidgetPlugin::class,
            ProductBundleItemsWidgetPlugin::class,
        ];
    }

    /**
     * @return CartItemTransformerPluginInterface[]
     */
    protected function getCartItemTransformerPlugins(): array
    {
        return [
            new ProductBundleCartItemTransformerPlugin()
        ];
    }
}
