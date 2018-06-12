<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CategoryStorage;

use Spryker\Zed\CategoryStorage\CategoryStorageConfig as AbstractCategoryStorageConfig;

class CategoryStorageConfig extends AbstractCategoryStorageConfig
{
    /**
     * @return bool
     */
    public function isSendingToQueue()
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getCategoryTreeSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }

    /**
     * @return string|null
     */
    public function getCategoryNodeSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
