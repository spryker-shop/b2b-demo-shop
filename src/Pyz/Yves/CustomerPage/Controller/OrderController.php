<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Controller;

use Generated\Shared\Transfer\OrderTransfer;
use SprykerShop\Yves\CustomerPage\Controller\OrderController as SprykerShopOrderController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class OrderController extends SprykerShopOrderController
{
    /**
     * @param int $idSalesOrder
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return array
     */
    protected function getOrderDetailsResponseData(int $idSalesOrder): array
    {
        $responseData = parent::getOrderDetailsResponseData($idSalesOrder);

        if (!isset($responseData['order'])) {
            throw new NotFoundHttpException(sprintf(
                "Order with provided ID %s doesn't exist",
                $idSalesOrder
            ));
        }

        $orderTransfer = $responseData['order'];

        $responseData['products'] = $this->getFactory()
            ->createCartItemsProductsProvider()
            ->getItemsProducts($this->getCartItems($orderTransfer), $this->getLocale());

        return $responseData;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return array
     */
    protected function getCartItems(OrderTransfer $orderTransfer): array
    {
        return $orderTransfer->getItems()->getArrayCopy();
    }
}
