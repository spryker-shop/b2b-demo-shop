<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\MultiCartPage\Controller;

use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use SprykerShop\Yves\MultiCartPage\Controller\MultiCartController as SprykerShopMultiCartController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerShop\Yves\MultiCartPage\MultiCartPageFactory getFactory()
 */
class MultiCartController extends SprykerShopMultiCartController
{
    public const REQUEST_HEADER_REFERER = 'referer';

    /**
     * @param int $idQuote
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function setDefaultBackAction(int $idQuote, Request $request)
    {
        $multiCartClient = $this->getFactory()
            ->getMultiCartClient();

        $quoteTransfer = $multiCartClient->findQuoteById($idQuote);

        if (!$quoteTransfer) {
            $this->addInfoMessage(static::GLOSSARY_KEY_PERMISSION_FAILED);

            return $this->redirectResponseExternal($this->getRefererUrl($request));
        }

        $multiCartClient->markQuoteAsDefault($quoteTransfer);

        $this->getFactory()->getCartClient()->validateQuote();

        return $this->redirectResponseExternal($this->getRefererUrl($request));
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getRefererUrl(Request $request): string
    {
        if ($request->headers->has(static::REQUEST_HEADER_REFERER)) {
            return $request->headers->get(static::REQUEST_HEADER_REFERER);
        }

        return CartControllerProvider::ROUTE_CART;
    }
}
