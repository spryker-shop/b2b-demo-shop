<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUserStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CompanyUserStorage\CompanyUserStorageConfig as SprykerCompanyUserStorageConfig;

class CompanyUserStorageConfig extends SprykerCompanyUserStorageConfig
{
    /**
     * @return string|null
     */
    public function getCompanyUserSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
