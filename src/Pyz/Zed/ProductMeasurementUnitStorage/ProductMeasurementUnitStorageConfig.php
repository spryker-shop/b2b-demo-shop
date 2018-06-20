<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductMeasurementUnitStorage;

use Spryker\Zed\ProductMeasurementUnitStorage\ProductMeasurementUnitStorageConfig as AbstractProductMeasurementUnitStorageConfig;

class ProductMeasurementUnitStorageConfig extends AbstractProductMeasurementUnitStorageConfig
{
    /**
     * @return bool
     */
    public function isSendingToQueue()
    {
        return true;
    }

    /**
     * @return null|string
     */
    public function getProductMeasurementUnitSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
