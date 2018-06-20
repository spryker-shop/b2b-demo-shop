<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\UrlStorage;

use Spryker\Zed\UrlStorage\UrlStorageConfig as AbstractUrlStorageConfig;

class UrlStorageConfig extends AbstractUrlStorageConfig
{
    /**
     * @return null|string
     */
    public function getUrlSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }

    /**
     * @return null|string
     */
    public function getUrlRedirectSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
