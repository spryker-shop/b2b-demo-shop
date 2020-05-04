<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ShoppingList;

use Spryker\Zed\ProductBundle\Communication\Plugin\ShoppingList\ReplaceBundledQuoteItemsPreConvertPlugin;
use Spryker\Zed\ProductDiscontinued\Communication\Plugin\ShoppingList\ProductDiscontinuedAddItemPreCheckPlugin;
use Spryker\Zed\ShoppingList\Communication\Plugin\ShoppingListItemProductConcreteActiveAddItemPreCheckPlugin;
use Spryker\Zed\ShoppingList\ShoppingListDependencyProvider as SprykerShoppingListDependencyProvider;
use Spryker\Zed\ShoppingListNote\Communication\Plugin\ItemCartNoteToShoppingListItemNoteMapperPlugin;
use Spryker\Zed\ShoppingListNote\Communication\Plugin\ShoppingListItemNoteBeforeDeletePlugin;
use Spryker\Zed\ShoppingListNote\Communication\Plugin\ShoppingListItemNoteExpanderPlugin;
use Spryker\Zed\ShoppingListNote\Communication\Plugin\ShoppingListItemNotePostSavePlugin;
use Spryker\Zed\ShoppingListProductOptionConnector\Communication\Plugin\ShoppingList\CartItemProductOptionToShoppingListItemProductOptionMapperPlugin;
use Spryker\Zed\ShoppingListProductOptionConnector\Communication\Plugin\ShoppingList\ShoppingListItemProductOptionBeforeDeletePlugin;
use Spryker\Zed\ShoppingListProductOptionConnector\Communication\Plugin\ShoppingList\ShoppingListItemProductOptionExpanderPlugin;
use Spryker\Zed\ShoppingListProductOptionConnector\Communication\Plugin\ShoppingList\ShoppingListItemProductOptionPostSavePlugin;

class ShoppingListDependencyProvider extends SprykerShoppingListDependencyProvider
{
    /**
     * @return \Spryker\Zed\ShoppingListExtension\Dependency\Plugin\AddItemPreCheckPluginInterface[]
     */
    protected function getAddItemPreCheckPlugins(): array
    {
        return [
            new ProductDiscontinuedAddItemPreCheckPlugin(), #ProductDiscontinuedFeature
            new ShoppingListItemProductConcreteActiveAddItemPreCheckPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ShoppingListExtension\Dependency\Plugin\QuoteItemsPreConvertPluginInterface[]
     */
    protected function getQuoteItemExpanderPlugins(): array
    {
        return [
            new ReplaceBundledQuoteItemsPreConvertPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ShoppingListExtension\Dependency\Plugin\ShoppingListItemPostSavePluginInterface[]
     */
    protected function getShoppingListItemPostSavePlugins(): array
    {
        return [
            new ShoppingListItemNotePostSavePlugin(), #ShoppingListNoteFeature
            new ShoppingListItemProductOptionPostSavePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ShoppingListExtension\Dependency\Plugin\ShoppingListItemBeforeDeletePluginInterface[]
     */
    protected function getBeforeDeleteShoppingListItemPlugins(): array
    {
        return [
            new ShoppingListItemNoteBeforeDeletePlugin(), #ShoppingListNoteFeature
            new ShoppingListItemProductOptionBeforeDeletePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ShoppingListExtension\Dependency\Plugin\ItemExpanderPluginInterface[]
     */
    protected function getItemExpanderPlugins(): array
    {
        return [
            new ShoppingListItemNoteExpanderPlugin(), #ShoppingListNoteFeature
            new ShoppingListItemProductOptionExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ShoppingListExtension\Dependency\Plugin\ItemToShoppingListItemMapperPluginInterface[]
     */
    protected function getItemToShoppingListItemMapperPlugins(): array
    {
        return [
            new ItemCartNoteToShoppingListItemNoteMapperPlugin(),
            new CartItemProductOptionToShoppingListItemProductOptionMapperPlugin(),
        ];
    }
}
