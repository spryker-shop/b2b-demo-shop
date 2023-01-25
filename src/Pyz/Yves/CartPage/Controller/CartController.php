<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage\Controller;

use SprykerShop\Yves\CartPage\Controller\CartController as SprykerCartController;
use SprykerShop\Yves\CartPage\Plugin\Router\CartPageRouteProviderPlugin;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\CartPage\CartPageFactory getFactory()
 */
class CartController extends SprykerCartController
{
    /**
     * @var string
     */
    protected const PYZ_PARAM_REFERER = 'referer';

    /**
     * @param array $selectedAttributes
     *
     * @return array
     */
    protected function executeIndexAction(array $selectedAttributes = []): array
    {
        $viewData = parent::executeIndexAction($selectedAttributes);
        $cartItems = $viewData['cartItems'];

        $viewData['products'] = $this->getFactory()
            ->createPyzCartItemsProductsProvider()
            ->getItemsProducts($cartItems, $this->getLocale());

        return $viewData;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $sku
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, $sku): RedirectResponse
    {
        parent::addAction($request, $sku);

        return $this->redirectPyzToReferer($request);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectPyzToReferer(Request $request): RedirectResponse
    {
        return $request->headers->has(static::PYZ_PARAM_REFERER) ?
            $this->redirectResponseExternal($request->headers->get(static::PYZ_PARAM_REFERER))
            : $this->redirectResponseInternal(CartPageRouteProviderPlugin::ROUTE_NAME_CART);
    }
}
