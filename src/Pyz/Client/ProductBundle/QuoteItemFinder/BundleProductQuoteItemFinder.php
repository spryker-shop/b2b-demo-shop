<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ProductBundle\QuoteItemFinder;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\ProductBundle\QuoteItemFinder\BundleProductQuoteItemFinder as SprykerBundleProductQuoteItemFinder;

class BundleProductQuoteItemFinder extends SprykerBundleProductQuoteItemFinder
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string|null $groupKey
     *
     * @return int
     */
    protected function getBundledProductTotalQuantity(QuoteTransfer $quoteTransfer, ?string $groupKey = null): int
    {
        $bundleItemQuantity = 0;
        foreach ($quoteTransfer->getBundleItems() as $bundleItemTransfer) {
            if ($bundleItemTransfer->getGroupKey() !== $groupKey) {
                continue;
            }
            $bundleItemQuantity += $bundleItemTransfer->getQuantity();
        }

        return $bundleItemQuantity;
    }
}
