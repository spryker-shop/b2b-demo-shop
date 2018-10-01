<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ProductBundle;

use Pyz\Client\ProductBundle\QuoteItemFinder\BundleProductQuoteItemFinder;
use Spryker\Client\ProductBundle\ProductBundleFactory as SprykerProductBundleFactory;
use Spryker\Client\ProductBundle\QuoteItemFinder\BundleProductQuoteItemFinderInterface;

class ProductBundleFactory extends SprykerProductBundleFactory
{
    /**
     * @return \Spryker\Client\ProductBundle\QuoteItemFinder\BundleProductQuoteItemFinderInterface
     */
    public function createBundleProductQuoteItemFinder(): BundleProductQuoteItemFinderInterface
    {
        return new BundleProductQuoteItemFinder();
    }
}
