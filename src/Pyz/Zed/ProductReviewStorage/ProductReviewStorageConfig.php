<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductReviewStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ProductReviewStorage\ProductReviewStorageConfig as AbstractProductReviewStorageConfig;

class ProductReviewStorageConfig extends AbstractProductReviewStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductAbstractReviewSynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
