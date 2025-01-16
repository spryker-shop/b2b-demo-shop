<?php



declare(strict_types = 1);

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
