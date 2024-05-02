<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\MerchantSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\MerchantSearch\MerchantSearchConfig as SprykerMerchantSearchConfig;

class MerchantSearchConfig extends SprykerMerchantSearchConfig
{
    /**
     * @return string|null
     */
    public function getMerchantSearchSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
