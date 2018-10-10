<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage\Plugin\Provider;

use SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface;

class CartItemsProductProvider implements CartItemsProductProviderInterface
{
    /**
     * @var \SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface
     */
    protected $productStorageClient;

    /**
     * @var \SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface
     */
    public function __construct(CartPageToProductStorageClientInterface $productStorageClient)
    {
        $this->productStorageClient = $productStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer[] $cartItems
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\ProductViewTransfer[]
     */
    public function getItemsProducts(array $cartItems, string $locale): array
    {
        $productBySku = [];

        foreach ($cartItems as $item) {
            $productBySku[$item->getSku()] = $this->productStorageClient->mapProductStorageData(
                $this->productStorageClient->findProductAbstractStorageData(
                    $item->getIdProductAbstract(),
                    $locale
                ),
                $locale
            );
        }

        return $productBySku;
    }
}
