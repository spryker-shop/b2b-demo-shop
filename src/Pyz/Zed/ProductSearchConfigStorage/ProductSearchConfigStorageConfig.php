<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSearchConfigStorage;

use Spryker\Zed\ProductSearchConfigStorage\ProductSearchConfigStorageConfig as SprykerProductSearchConfigStorageConfig;

class ProductSearchConfigStorageConfig extends SprykerProductSearchConfigStorageConfig
{
    /**
     * @uses \Pyz\Zed\Synchronization\SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME
     */
    protected const DEFAULT_SYNCHRONIZATION_POOL_NAME = 'synchronizationPool';

    /**
     * @return null|string
     */
    public function getProductSearchConfigSynchronizationPoolName(): ?string
    {
        return static::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
