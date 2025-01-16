<?php



declare(strict_types = 1);

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
