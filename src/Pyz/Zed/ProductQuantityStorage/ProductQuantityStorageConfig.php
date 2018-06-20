<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductQuantityStorage;

use Spryker\Zed\ProductQuantityStorage\ProductQuantityStorageConfig as AbstractProductQuantityStorageConfig;

class ProductQuantityStorageConfig extends AbstractProductQuantityStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductQuantitySynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
