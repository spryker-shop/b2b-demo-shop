<?php



declare(strict_types = 1);

namespace Pyz\Yves\CartPage\Plugin\Provider;

interface CartItemsProductProviderInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $cartItems
     * @param string $locale
     *
     * @return array<\Generated\Shared\Transfer\ProductViewTransfer>
     */
    public function getItemsProducts(array $cartItems, string $locale): array;
}
