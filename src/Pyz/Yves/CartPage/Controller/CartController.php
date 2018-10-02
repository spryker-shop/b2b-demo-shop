<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage\Controller;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Yves\Kernel\PermissionAwareTrait;
use SprykerShop\Shared\CartPage\Plugin\AddCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\ChangeCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\RemoveCartItemPermissionPlugin;
use SprykerShop\Yves\CartPage\Controller\CartController as SprykerCartController;
use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use Symfony\Component\HttpFoundation\Request;

class CartController extends SprykerCartController
{
    use PermissionAwareTrait;

    public const REQUEST_HEADER_REFERER = 'referer';

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
        if (!$this->can(AddCartItemPermissionPlugin::KEY)) {
            $this->addErrorMessage("Access Denied");

            return $this->redirectResponseExternal($this->getRefererUrl($request));
        }

        $itemTransfer = new ItemTransfer();
        $itemTransfer
            ->setSku($sku)
            ->setQuantity($quantity);

        $this->addProductOptions($optionValueIds, $itemTransfer);

        $this->getFactory()
            ->getCartClient()
            ->addItem($itemTransfer, $request->request->all());

        $this->getFactory()
            ->getZedRequestClient()
            ->addFlashMessagesFromLastZedRequest();

        return $this->redirectResponseExternal($this->getRefererUrl($request));
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getRefererUrl(Request $request)
    {
        if ($request->headers->has(static::REQUEST_HEADER_REFERER)) {
            return $request->headers->get(static::REQUEST_HEADER_REFERER);
        }

        return CartControllerProvider::ROUTE_CART;
    }

    /**
     * @param string $sku
     * @param string|null $groupKey
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction($sku, $groupKey = null)
    {
        if (!$this->can(RemoveCartItemPermissionPlugin::KEY)) {
            $this->addErrorMessage("Access Denied");

            return $this->redirectResponseExternal(CartControllerProvider::ROUTE_CART);
        }

        return parent::removeAction($sku, $groupKey);
    }

    /**
     * @param string $sku
     * @param int $quantity
     * @param string|null $groupKey
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changeAction($sku, $quantity, $groupKey = null)
    {
        if (!$this->can(ChangeCartItemPermissionPlugin::KEY)) {
            $this->addErrorMessage("Access Denied");

            return $this->redirectResponseExternal(CartControllerProvider::ROUTE_CART);
        }

        return parent::changeAction($sku, $quantity, $groupKey);
    }
}
