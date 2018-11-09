<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ShoppingList;

use Spryker\Client\ShoppingList\ShoppingListDependencyProvider as SprykerShoppingListDependencyProvider;
use Spryker\Client\ShoppingListNote\Plugin\ShoppingListItemNoteToItemCartNoteMapperPlugin;
use Spryker\Client\ShoppingListProductOptionConnector\ShoppingList\ProductOptionQuoteItemToItemMapperPlugin;
use Spryker\Client\ShoppingListProductOptionConnector\ShoppingList\ShoppingListItemProductOptionRequestMapperPlugin;
use Spryker\Client\ShoppingListProductOptionConnector\ShoppingList\ShoppingListItemProductOptionToItemProductOptionMapperPlugin;

class ShoppingListDependencyProvider extends SprykerShoppingListDependencyProvider
{
    /**
     * @return \Spryker\Client\ShoppingListExtension\Dependency\Plugin\ShoppingListItemMapperPluginInterface[]
     */
    protected function getAddItemShoppingListItemMapperPlugins(): array
    {
        return [
            new ShoppingListItemProductOptionRequestMapperPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\ShoppingListExtension\Dependency\Plugin\ShoppingListItemToItemMapperPluginInterface[]
     */
    protected function getShoppingListItemToItemMapperPlugins(): array
    {
        return [
            new ShoppingListItemNoteToItemCartNoteMapperPlugin(),
            new ShoppingListItemProductOptionToItemProductOptionMapperPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\ShoppingListExtension\Dependency\Plugin\QuoteItemToItemMapperPluginInterface[]
     */
    protected function getQuoteItemToItemMapperPlugins(): array
    {
        return [
            new ProductOptionQuoteItemToItemMapperPlugin(),
        ];
    }
}
