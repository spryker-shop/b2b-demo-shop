<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\UrlStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\UrlStorage\UrlStorageConfig as AbstractUrlStorageConfig;

class UrlStorageConfig extends AbstractUrlStorageConfig
{
    /**
     * @return null|string
     */
    public function getUrlSynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return null|string
     */
    public function getUrlRedirectSynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
