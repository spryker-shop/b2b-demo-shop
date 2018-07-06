<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CategoryPageSearch;

use Spryker\Zed\CategoryPageSearch\CategoryPageSearchConfig as AbstractCategoryPageSearchConfig;

class CategoryPageSearchConfig extends AbstractCategoryPageSearchConfig
{
    /**
     * @uses \Pyz\Zed\Synchronization\SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME
     */
    public const DEFAULT_SYNCHRONIZATION_POOL_NAME = 'synchronizationPool';

    /**
     * @return string
     */
    public function getCategoryPageSynchronizationPoolName(): string
    {
        return static::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
