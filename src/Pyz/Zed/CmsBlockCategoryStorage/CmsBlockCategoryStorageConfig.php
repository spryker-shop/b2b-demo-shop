<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CmsBlockCategoryStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CmsBlockCategoryStorage\CmsBlockCategoryStorageConfig as AbstractCmsBlockCategoryStorageConfig;

class CmsBlockCategoryStorageConfig extends AbstractCmsBlockCategoryStorageConfig
{
    /**
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCmsBlockCategorySynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
