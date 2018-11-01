<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage\Controller;

use SprykerShop\Yves\CartPage\Controller\CartController as SprykerCartController;

/**
 * @method \Pyz\Yves\CartPage\CartPageFactory getFactory()
 */
class CartController extends SprykerCartController
{
    /**
     * @param array|null $selectedAttributes
     *
     * @return array
     */
    protected function executeIndexAction(?array $selectedAttributes): array
    {
        $validateQuoteResponseTransfer = $this->getFactory()
            ->getCartClient()
            ->validateQuote();

        $this->getFactory()
            ->getZedRequestClient()
            ->addFlashMessagesFromLastZedRequest();

        $quoteTransfer = $validateQuoteResponseTransfer->getQuoteTransfer();

        $cartItems = $this->getFactory()
            ->createCartItemReader()
            ->getCartItems($quoteTransfer);

        $itemAttributeVariantsBySku = $this->getFactory()
            ->createCartItemsAttributeProvider()
            ->getItemsAttributes($quoteTransfer, $this->getLocale(), $selectedAttributes);

        $productBySku = $this->getFactory()
            ->createCartItemsProductsProvider()
            ->getItemsProducts($cartItems, $this->getLocale());

        return [
            'cart' => $quoteTransfer,
            'cartItems' => $cartItems,
            'products' => $productBySku,
            'attributes' => $itemAttributeVariantsBySku,
            'isQuoteValid' => $validateQuoteResponseTransfer->getIsSuccessful(),
        ];
    }
}
