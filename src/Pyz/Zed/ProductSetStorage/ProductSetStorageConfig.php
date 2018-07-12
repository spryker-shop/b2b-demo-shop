<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSetStorage;

use Spryker\Zed\ProductSetStorage\ProductSetStorageConfig as SprykerProductSetStorageConfig;

class ProductSetStorageConfig extends SprykerProductSetStorageConfig
{
    /**
     * @uses \Pyz\Zed\Synchronization\SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME
     */
    protected const DEFAULT_SYNCHRONIZATION_POOL_NAME = 'synchronizationPool';

    /**
     * @return null|string
     */
    public function getProductSetSynchronizationPoolName(): ?string
    {
        return static::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
