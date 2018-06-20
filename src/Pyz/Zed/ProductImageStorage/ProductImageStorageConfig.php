<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductImageStorage;

use Spryker\Zed\ProductImageStorage\ProductImageStorageConfig as AbstractProductImageStorageConfig;

class ProductImageStorageConfig extends AbstractProductImageStorageConfig
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
    public function getProductImageSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
