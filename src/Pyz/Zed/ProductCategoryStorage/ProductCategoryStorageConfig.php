<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductCategoryStorage;

use Spryker\Zed\ProductCategoryStorage\ProductCategoryStorageConfig as AbstractProductCategoryStorageConfig;

class ProductCategoryStorageConfig extends AbstractProductCategoryStorageConfig
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
    public function getProductCategorySynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
