<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductLabelStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ProductLabelStorage\ProductLabelStorageConfig as SprykerProductLabelStorageConfig;

class ProductLabelStorageConfig extends SprykerProductLabelStorageConfig
{
    /**
     * @return null|string
     */
    public function getProductAbstractLabelSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return null|string
     */
    public function getProductLabelDictionarySynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
