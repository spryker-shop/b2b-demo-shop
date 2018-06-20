<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductStorage;

use Spryker\Zed\ProductStorage\ProductStorageConfig as AbstractProductStorageConfig;

class ProductStorageConfig extends AbstractProductStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductConcreteSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }

    /**
     * @return null|string
     */
    public function getProductAbstractSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
