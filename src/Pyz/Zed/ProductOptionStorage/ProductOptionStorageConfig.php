<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductOptionStorage;

use Spryker\Zed\ProductOptionStorage\ProductOptionStorageConfig as AbstractProductOptionStorageConfig;

class ProductOptionStorageConfig extends AbstractProductOptionStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductAbstractOptionSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
