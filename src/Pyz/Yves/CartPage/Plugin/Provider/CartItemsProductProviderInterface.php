<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
