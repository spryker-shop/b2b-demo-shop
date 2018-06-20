<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductCategoryFilterStorage;

use Spryker\Zed\ProductCategoryFilterStorage\ProductCategoryFilterStorageConfig as AbstractProductCategoryFilterStorageConfig;

class ProductCategoryFilterStorageConfig extends AbstractProductCategoryFilterStorageConfig
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
    public function getProductCategoryFilterSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
