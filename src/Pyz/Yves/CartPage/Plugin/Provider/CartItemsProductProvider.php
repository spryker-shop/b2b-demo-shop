<?php



declare(strict_types = 1);

namespace Pyz\Yves\CartPage\Plugin\Provider;

use SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface;

class CartItemsProductProvider implements CartItemsProductProviderInterface
{
    /**
     * @var \SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface
     */
    protected $productStorageClient;

    /**
     * @param \SprykerShop\Yves\CartPage\Dependency\Client\CartPageToProductStorageClientInterface $productStorageClient
     */
    public function __construct(CartPageToProductStorageClientInterface $productStorageClient)
    {
        $this->productStorageClient = $productStorageClient;
    }

    /**
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $cartItems
     * @param string $locale
     *
     * @return array<\Generated\Shared\Transfer\ProductViewTransfer>
     */
    public function getItemsProducts(array $cartItems, string $locale): array
    {
        $productBySku = [];

        foreach ($cartItems as $item) {
            $productBySku[$item->getSku()] = $this->productStorageClient->findProductAbstractViewTransfer(
                $item->getIdProductAbstract(),
                $locale,
            );
        }

        return $productBySku;
    }
}
