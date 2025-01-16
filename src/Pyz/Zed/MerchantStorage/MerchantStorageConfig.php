<?php



declare(strict_types = 1);

namespace Pyz\Zed\MerchantStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\MerchantStorage\MerchantStorageConfig as BaseMerchantStorageConfig;

class MerchantStorageConfig extends BaseMerchantStorageConfig
{
    /**
     * @return string|null
     */
    public function getMerchantSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
