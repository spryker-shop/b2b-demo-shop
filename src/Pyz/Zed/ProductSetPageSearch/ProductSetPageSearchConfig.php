<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSetPageSearch;

use Spryker\Zed\ProductSetPageSearch\ProductSetPageSearchConfig as SprykerProductSetPageSearchConfig;

class ProductSetPageSearchConfig extends SprykerProductSetPageSearchConfig
{
    /**
     * @uses \Pyz\Zed\Synchronization\SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME
     */
    protected const DEFAULT_SYNCHRONIZATION_POOL_NAME = 'synchronizationPool';

    /**
     * @return null|string
     */
    public function getProductSetSynchronizationPoolName(): ?string
    {
        return static::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
