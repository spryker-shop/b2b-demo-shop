<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
