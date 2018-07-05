<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductCategoryFilterStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ProductCategoryFilterStorage\ProductCategoryFilterStorageConfig as AbstractProductCategoryFilterStorageConfig;

class ProductCategoryFilterStorageConfig extends AbstractProductCategoryFilterStorageConfig
{
    /**
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getProductCategoryFilterSynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
