<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSetStorage;

use Spryker\Zed\ProductSetStorage\ProductSetStorageConfig as AbstractProductSetStorageConfig;

class ProductSetStorageConfig extends AbstractProductSetStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductSetSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
