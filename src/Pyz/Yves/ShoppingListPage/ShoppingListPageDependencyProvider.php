<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShoppingListPage;

use Spryker\Client\AvailabilityStorage\Plugin\ProductViewAvailabilityStorageExpanderPlugin;
use Spryker\Client\PriceProductStorage\Plugin\ProductViewPriceExpanderPlugin;
use Spryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use SprykerShop\Yves\ProductAlternativeWidget\Plugin\ShoppingListPage\ProductAlternativeWidgetPlugin;
use SprykerShop\Yves\ProductBarcodeWidget\Plugin\ShoppingList\ProductBarcodeWidgetPlugin;
use SprykerShop\Yves\ProductDiscontinuedWidget\Plugin\ShoppingListPage\ProductDiscontinuedWidgetPlugin;
use SprykerShop\Yves\ShoppingListPage\ShoppingListPageDependencyProvider as SprykerShoppingListPageDependencyProvider;

class ShoppingListPageDependencyProvider extends SprykerShoppingListPageDependencyProvider
{
    /**
     * @return \Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface[]
     */
    protected function getShoppingListItemExpanderPlugins(): array
    {
        return [
            new ProductViewPriceExpanderPlugin(),
            new ProductViewImageExpanderPlugin(),
            new ProductViewAvailabilityStorageExpanderPlugin(),
        ];
    }

    /**
     * @return string[]
     */
    protected function getShoppingListWidgetPlugins(): array
    {
        return [
            ProductBarcodeWidgetPlugin::class,
        ];
    }

    /**
     * Returns a list of widget plugin class names that implement
     * \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface.
     *
     * @return string[]
     */
    protected function getShoppingListViewWidgetPlugins(): array
    {
        return [
            ProductAlternativeWidgetPlugin::class, #ProductAlternativeFeature
            ProductDiscontinuedWidgetPlugin::class, #ProductDiscontinuedFeature
        ];
    }
}
