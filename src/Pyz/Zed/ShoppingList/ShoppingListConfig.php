<?php



declare(strict_types = 1);

namespace Pyz\Zed\ShoppingList;

use Spryker\Zed\ShoppingList\ShoppingListConfig as SprykerShoppingListConfig;

class ShoppingListConfig extends SprykerShoppingListConfig
{
    /**
     * @return bool
     */
    public function isShoppingListOverviewWithShoppingLists(): bool
    {
        return false;
    }
}
