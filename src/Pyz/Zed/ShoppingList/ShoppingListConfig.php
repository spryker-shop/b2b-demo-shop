<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
