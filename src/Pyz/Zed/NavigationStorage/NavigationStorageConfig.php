<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\NavigationStorage;

use Spryker\Zed\NavigationStorage\NavigationStorageConfig as AbstractNavigationStorageConfig;

class NavigationStorageConfig extends AbstractNavigationStorageConfig
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
    public function getNavigationSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
