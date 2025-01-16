<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductBundleStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ProductBundleStorage\ProductBundleStorageConfig as SprykerProductBundleStorageConfig;

class ProductBundleStorageConfig extends SprykerProductBundleStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductBundleSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
