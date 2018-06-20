<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CmsStorage;

use Spryker\Zed\CmsStorage\CmsStorageConfig as AbstractCmsStorageConfig;

class CmsStorageConfig extends AbstractCmsStorageConfig
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
    public function getCmsPageSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
