<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductReviewSearch;

use Spryker\Zed\ProductReviewSearch\ProductReviewSearchConfig as AbstractProductReviewSearchConfig;

class ProductReviewSearchConfig extends AbstractProductReviewSearchConfig
{
    /**
     * @return null|string
     */
    public function getProductReviewSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
