<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ShoppingList\Business\Model;

use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\ShoppingListItemTransfer;
use Spryker\Zed\ShoppingList\Business\Model\ShoppingListItemOperation as SprykerShoppingListItemOperation;

class ShoppingListItemOperation extends SprykerShoppingListItemOperation
{
    /**
     * @param \Generated\Shared\Transfer\ShoppingListItemTransfer $shoppingListItemTransfer
     *
     * @return bool
     */
    protected function assertItem(ShoppingListItemTransfer $shoppingListItemTransfer): bool
    {
        if ($shoppingListItemTransfer->getQuantity() === 0) {
            $this->messengerFacade->addErrorMessage(
                (new MessageTransfer())
                    ->setValue(static::GLOSSARY_KEY_CUSTOMER_ACCOUNT_SHOPPING_LIST_ITEM_ADD_FAILED)
                    ->setParameters([static::GLOSSARY_PARAM_SKU => $shoppingListItemTransfer->getSku()])
            );

            return false;
        }

        return parent::assertItem($shoppingListItemTransfer);
    }
}
