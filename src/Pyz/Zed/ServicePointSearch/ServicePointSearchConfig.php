<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ServicePointSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ServicePointSearch\ServicePointSearchConfig as SprykerServicePointSearchConfig;

class ServicePointSearchConfig extends SprykerServicePointSearchConfig
{
    /**
     * @return string|null
     */
    public function getServicePointSearchSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
