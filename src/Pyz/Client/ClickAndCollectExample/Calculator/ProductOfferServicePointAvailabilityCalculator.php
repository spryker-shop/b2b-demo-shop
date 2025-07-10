<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ClickAndCollectExample\Calculator;

use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityRequestItemTransfer;
use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityResponseItemTransfer;
use Spryker\Client\ClickAndCollectExample\Calculator\ProductOfferServicePointAvailabilityCalculator as SprykerProductOfferServicePointAvailabilityCalculator;

class ProductOfferServicePointAvailabilityCalculator extends SprykerProductOfferServicePointAvailabilityCalculator
{
    /**
     * @param \Generated\Shared\Transfer\ProductOfferServicePointAvailabilityRequestItemTransfer $productOfferServicePointAvailabilityRequestItemTransfer
     * @param \Generated\Shared\Transfer\ProductOfferServicePointAvailabilityResponseItemTransfer $productOfferServicePointAvailabilityResponseItemTransfer
     *
     * @return bool
     */
    protected function isAvailabilityApplicableByMerchantReference(
        ProductOfferServicePointAvailabilityRequestItemTransfer $productOfferServicePointAvailabilityRequestItemTransfer,
        ProductOfferServicePointAvailabilityResponseItemTransfer $productOfferServicePointAvailabilityResponseItemTransfer,
    ): bool {
        if (!$productOfferServicePointAvailabilityRequestItemTransfer->getMerchantReference()) {
            return $productOfferServicePointAvailabilityRequestItemTransfer->getProductConcreteSku() === $productOfferServicePointAvailabilityResponseItemTransfer->getProductConcreteSku();
        }

        return $productOfferServicePointAvailabilityRequestItemTransfer->getMerchantReferenceOrFail() === $productOfferServicePointAvailabilityResponseItemTransfer->getMerchantReference();
    }
}
