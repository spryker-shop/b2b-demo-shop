<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage\Controller;

use SprykerShop\Yves\CartPage\Controller\CartController as SprykerCartController;
use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\CartPage\CartPageFactory getFactory()
 */
class CartController extends SprykerCartController
{
    protected const PARAM_REFERER = 'referer';

    /**
     * @param array|null $selectedAttributes
     *
     * @return array
     */
    protected function executeIndexAction(?array $selectedAttributes): array
    {
        $viewData = parent::executeIndexAction($selectedAttributes);
        $cartItems = $viewData['cartItems'];

        $viewData['products'] = $this->getFactory()
            ->createCartItemsProductsProvider()
            ->getItemsProducts($cartItems, $this->getLocale());

        return $viewData;
    }

    /**
     * @param string $sku
     * @param int $quantity
     * @param array $optionValueIds
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction($sku, $quantity, array $optionValueIds, Request $request)
    {
        parent::addAction($sku, $quantity, $optionValueIds, $request);

        return $this->redirectToReferer($request);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToReferer(Request $request): RedirectResponse
    {
        return $request->headers->has(static::PARAM_REFERER) ?
            $this->redirectResponseExternal($request->headers->get(static::PARAM_REFERER))
            : $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }
}
