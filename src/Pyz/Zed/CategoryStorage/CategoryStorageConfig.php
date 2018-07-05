<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CategoryStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CategoryStorage\CategoryStorageConfig as AbstractCategoryStorageConfig;

class CategoryStorageConfig extends AbstractCategoryStorageConfig
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
    public function getCategoryTreeSynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return string
     */
    public function getCategoryNodeSynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
