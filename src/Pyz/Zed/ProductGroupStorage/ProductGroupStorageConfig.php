<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductGroupStorage;

use Spryker\Zed\ProductGroupStorage\ProductGroupStorageConfig as AbstractProductGroupStorageConfig;

class ProductGroupStorageConfig extends AbstractProductGroupStorageConfig
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
    public function getProductGroupSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
