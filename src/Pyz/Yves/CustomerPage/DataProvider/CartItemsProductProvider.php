<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\DataProvider;

use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToProductStorageClientInterface;

class CartItemsProductProvider implements CartItemsProductProviderInterface
{
    /**
     * @var \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToProductStorageClientInterface
     */
    protected $productStorageClient;

    /**
     * @param \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToProductStorageClientInterface $productStorageClient
     */
    public function __construct(CustomerPageToProductStorageClientInterface $productStorageClient)
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
            $productBySku[$item->getSku()] = $this->productStorageClient->findProductAbstractViewTransfer(
                $item->getIdProductAbstract(),
                $locale
            );
        }

        return $productBySku;
    }
}
