<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\ProductBundle\QuoteItemFinder;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\ProductBundle\QuoteItemFinder\BundleProductQuoteItemFinder as SprykerBundleProductQuoteItemFinder;

class BundleProductQuoteItemFinder extends SprykerBundleProductQuoteItemFinder
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $groupKey
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
