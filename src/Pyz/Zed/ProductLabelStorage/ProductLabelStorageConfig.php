<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductLabelStorage;

use Spryker\Zed\ProductLabelStorage\ProductLabelStorageConfig as AbstractProductLabelStorageConfig;

class ProductLabelStorageConfig extends AbstractProductLabelStorageConfig
{
    /**
     * @return bool
     */
    public function isSendingToQueue()
    {
        return true;
    }

    /**
     * @return null|string
     */
    public function getProductAbstractLabelSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }

    /**
     * @return null|string
     */
    public function getProductLabelDictionarySynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
