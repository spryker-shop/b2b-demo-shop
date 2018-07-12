<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductCategoryFilterStorage;

use Spryker\Zed\ProductCategoryFilterStorage\ProductCategoryFilterStorageConfig as SprykerProductCategoryFilterStorageConfig;

class ProductCategoryFilterStorageConfig extends SprykerProductCategoryFilterStorageConfig
{
    /**
     * @uses \Pyz\Zed\Synchronization\SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME
     */
    protected const DEFAULT_SYNCHRONIZATION_POOL_NAME = 'synchronizationPool';

    /**
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getProductCategoryFilterSynchronizationPoolName(): ?string
    {
        return static::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
