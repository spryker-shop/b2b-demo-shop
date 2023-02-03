<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShoppingListPage;

use Spryker\Client\AvailabilityStorage\Plugin\ProductViewAvailabilityStorageExpanderPlugin;
use Spryker\Client\PriceProductStorage\Plugin\ProductViewPriceExpanderPlugin;
use Spryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\ShoppingListPage\ShoppingListItemProductOptionFormDataProviderMapperPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\ShoppingListPage\ShoppingListItemProductOptionFormExpanderPlugin;
use SprykerShop\Yves\ShoppingListNoteWidget\Plugin\ShoppingListPage\ShoppingListItemNoteFormExpanderPlugin;
use SprykerShop\Yves\ShoppingListPage\ShoppingListPageDependencyProvider as SprykerShoppingListPageDependencyProvider;

class ShoppingListPageDependencyProvider extends SprykerShoppingListPageDependencyProvider
{
    /**
     * @return array<\Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface>
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
     * @return array<\SprykerShop\Yves\ShoppingListPageExtension\Dependency\Plugin\ShoppingListItemFormExpanderPluginInterface>
     */
    protected function getShoppingListItemFormExpanderPlugins(): array
    {
        return [
            new ShoppingListItemNoteFormExpanderPlugin(), #ShoppingListNoteFeature
            new ShoppingListItemProductOptionFormExpanderPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\ShoppingListPageExtension\Dependency\Plugin\ShoppingListFormDataProviderMapperPluginInterface>
     */
    protected function getShoppingListFormDataProviderMapperPlugins(): array
    {
        return [
            new ShoppingListItemProductOptionFormDataProviderMapperPlugin(),
        ];
    }
}
