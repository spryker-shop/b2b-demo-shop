<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSearchConfigStorage;

use Spryker\Zed\ProductSearchConfigStorage\ProductSearchConfigStorageConfig as AbstractProductSearchConfigStorageConfig;

class ProductSearchConfigStorageConfig extends AbstractProductSearchConfigStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductSearchConfigSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
