<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ClickAndCollectExample;

use Pyz\Client\ClickAndCollectExample\Calculator\ProductOfferServicePointAvailabilityCalculator;
use Spryker\Client\ClickAndCollectExample\Calculator\ProductOfferServicePointAvailabilityCalculatorInterface;
use Spryker\Client\ClickAndCollectExample\ClickAndCollectExampleFactory as SprykerClickAndCollectExampleFactory;

class ClickAndCollectExampleFactory extends SprykerClickAndCollectExampleFactory
{
    /**
     * @return \Spryker\Client\ClickAndCollectExample\Calculator\ProductOfferServicePointAvailabilityCalculatorInterface
     */
    public function createProductOfferServicePointAvailabilityCalculator(): ProductOfferServicePointAvailabilityCalculatorInterface
    {
        return new ProductOfferServicePointAvailabilityCalculator(
            $this->createProductOfferServicePointAvailabilityResponseItemSorter(),
        );
    }
}
