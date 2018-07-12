<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductReviewStorage;

use Spryker\Zed\ProductReviewStorage\ProductReviewStorageConfig as SprykerProductReviewStorageConfig;

class ProductReviewStorageConfig extends SprykerProductReviewStorageConfig
{
    /**
     * @uses \Pyz\Zed\Synchronization\SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME
     */
    protected const DEFAULT_SYNCHRONIZATION_POOL_NAME = 'synchronizationPool';

    /**
     * @return null|string
     */
    public function getProductAbstractReviewSynchronizationPoolName(): ?string
    {
        return static::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
