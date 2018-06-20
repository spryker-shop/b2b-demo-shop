<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductRelationStorage;

use Spryker\Zed\ProductRelationStorage\ProductRelationStorageConfig as AbstractProductRelationStorageConfig;

class ProductRelationStorageConfig extends AbstractProductRelationStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductAbstractRelationSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
