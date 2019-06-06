<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage\Plugin\Provider;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Client\ProductQuantityStorage\ProductQuantityStorageClientInterface;
use SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface;

class CartItemsProductProvider implements CartItemsProductProviderInterface
{
    /**
     * @var \SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface
     */
    protected $productStorageClient;
    /**
     * @var \Spryker\Client\ProductQuantityStorage\ProductQuantityStorageClientInterface
     */
    protected $productQuantityStorageClient;

    /**
     * @param \SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface $productStorageClient
     * @param \Spryker\Client\ProductQuantityStorage\ProductQuantityStorageClientInterface $productQuantityStorageClient
     */
    public function __construct(
        CartPageToProductStorageClientInterface $productStorageClient,
        ProductQuantityStorageClientInterface $productQuantityStorageClient
    )
    {
        $this->productStorageClient = $productStorageClient;
        $this->productQuantityStorageClient = $productQuantityStorageClient;
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
            $productViewTransfer = $this->productStorageClient->findProductAbstractViewTransfer(
                $item->getIdProductAbstract(),
                $locale
            );
            $productViewTransfer = $this->setQuantityRestrictions($productViewTransfer, $item);
            $productBySku[$item->getSku()] = $productViewTransfer;
        }

        return $productBySku;
    }

    protected function setQuantityRestrictions(ProductViewTransfer $productViewTransfer, ItemTransfer $itemTransfer): ProductViewTransfer
    {
        $minQuantity = 1;
        $maxQuantity = null;
        $quantityInterval = 1;
        $productQuantityStorageTransfer = $this->productQuantityStorageClient
            ->findProductQuantityStorage($itemTransfer->getId());
        if ($productQuantityStorageTransfer !== null) {
            $minQuantity = $productQuantityStorageTransfer->getQuantityMin() ?? 1;
            $maxQuantity = $productQuantityStorageTransfer->getQuantityMax();
            $quantityInterval = $productQuantityStorageTransfer->getQuantityInterval() ?? 1;
        }
        $productViewTransfer->setQuantityMin($minQuantity);
        $productViewTransfer->setQuantityMax($maxQuantity);
        $productViewTransfer->setQuantityInterval($quantityInterval);

        return $productViewTransfer;
    }
}
