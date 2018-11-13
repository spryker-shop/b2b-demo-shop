<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ShoppingList\Business;

use Pyz\Zed\ShoppingList\Business\Model\ShoppingListItemOperation;
use Spryker\Zed\ShoppingList\Business\Model\ShoppingListItemOperationInterface;
use Spryker\Zed\ShoppingList\Business\ShoppingListBusinessFactory as SprykerShoppingListBusinessFactory;

class ShoppingListBusinessFactory extends SprykerShoppingListBusinessFactory
{
    /**
     * @return \Spryker\Zed\ShoppingList\Business\Model\ShoppingListItemOperationInterface
     */
    public function createShoppingListItemOperation(): ShoppingListItemOperationInterface
    {
        return new ShoppingListItemOperation(
            $this->getEntityManager(),
            $this->getProductFacade(),
            $this->getRepository(),
            $this->createShoppingListResolver(),
            $this->getMessengerFacade(),
            $this->createShoppingListItemPluginExecutor()
        );
    }
}
