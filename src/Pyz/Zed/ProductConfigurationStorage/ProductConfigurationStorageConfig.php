<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductConfigurationStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ProductConfigurationStorage\ProductConfigurationStorageConfig as SprykerProductConfigurationStorageConfig;

class ProductConfigurationStorageConfig extends SprykerProductConfigurationStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductConfigurationSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
