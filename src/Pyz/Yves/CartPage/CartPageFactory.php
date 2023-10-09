<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage;

use Pyz\Yves\CartPage\Plugin\Provider\CartItemsProductProvider;
use Pyz\Yves\CartPage\Plugin\Provider\CartItemsProductProviderInterface;
use SprykerShop\Yves\CartPage\CartPageFactory as SprykerCartPageFactory;

class CartPageFactory extends SprykerCartPageFactory
{
    /**
     * @return \Pyz\Yves\CartPage\Plugin\Provider\CartItemsProductProviderInterface
     */
    public function createCartItemsProductsProvider(): CartItemsProductProviderInterface
    {
        return new CartItemsProductProvider(
            $this->getProductStorageClient(),
        );
    }
}
