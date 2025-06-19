<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Yves\CartPage;

use SprykerFeature\Yves\SelfServicePortal\Plugin\CartPage\ProductOfferPreAddToCartPlugin;
use SprykerFeature\Yves\SelfServicePortal\Plugin\CartPage\ServiceDateTimeEnabledPreAddToCartPlugin;
use SprykerFeature\Yves\SelfServicePortal\Plugin\CartPage\ServiceDateTimePreAddToCartPlugin;
use SprykerFeature\Yves\SelfServicePortal\Plugin\CartPage\ServicePointPreAddToCartPlugin;
use SprykerFeature\Yves\SelfServicePortal\Plugin\CartPage\ShipmentTypePreAddToCartPlugin;
use SprykerFeature\Yves\SelfServicePortal\Plugin\CartPage\SspAssetPreAddToCartPlugin;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\CartPage\DiscountPromotionAddToCartFormWidgetParameterExpanderPlugin;
use SprykerShop\Yves\MerchantProductOfferWidget\Plugin\CartPage\MerchantProductOfferPreAddToCartPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\CartPage\MultiCartMiniCartViewExpanderPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CartPage\ProductBundleCartItemTransformerPlugin;
use SprykerShop\Yves\UrlPage\Plugin\CartPage\UrlCartItemTransformerPlugin;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\CartPageExtension\Dependency\Plugin\CartItemTransformerPluginInterface>
     */
    protected function getCartItemTransformerPlugins(): array
    {
        return [
            new ProductBundleCartItemTransformerPlugin(),
            new UrlCartItemTransformerPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CartPageExtension\Dependency\Plugin\AddToCartFormWidgetParameterExpanderPluginInterface>
     */
    protected function getAddToCartFormWidgetParameterExpanderPlugins(): array
    {
        return [
            new DiscountPromotionAddToCartFormWidgetParameterExpanderPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CartPageExtension\Dependency\Plugin\MiniCartViewExpanderPluginInterface>
     */
    protected function getMiniCartViewExpanderPlugins(): array
    {
        return [
            new MultiCartMiniCartViewExpanderPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CartPageExtension\Dependency\Plugin\PreAddToCartPluginInterface>
     */
    protected function getPreAddToCartPlugins(): array
    {
        return [
            new MerchantProductOfferPreAddToCartPlugin(),
            new ProductOfferPreAddToCartPlugin(),
            new ServicePointPreAddToCartPlugin(),
            new ShipmentTypePreAddToCartPlugin(),
            new SspAssetPreAddToCartPlugin(),
            new ServiceDateTimePreAddToCartPlugin(),
            new ServiceDateTimeEnabledPreAddToCartPlugin(),
        ];
    }
}
