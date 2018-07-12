<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductMeasurementUnitStorage;

use Spryker\Zed\ProductMeasurementUnitStorage\ProductMeasurementUnitStorageConfig as SprykerProductMeasurementUnitStorageConfig;

class ProductMeasurementUnitStorageConfig extends SprykerProductMeasurementUnitStorageConfig
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
     * @return null|string
     */
    public function getProductMeasurementUnitSynchronizationPoolName(): ?string
    {
        return static::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
