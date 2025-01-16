<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductImageStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\ProductImageStorage\ProductImageStorageConfig as SprykerSharedProductImageStorageConfig;
use Spryker\Zed\ProductImageStorage\ProductImageStorageConfig as SprykerProductImageStorageConfig;

class ProductImageStorageConfig extends SprykerProductImageStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductImageSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return string|null
     */
    public function getProductImageAbstractEventQueueName(): ?string
    {
        return SprykerSharedProductImageStorageConfig::PUBLISH_PRODUCT_ABSTRACT_IMAGE;
    }

    /**
     * @return string|null
     */
    public function getProductImageConcreteEventQueueName(): ?string
    {
        return SprykerSharedProductImageStorageConfig::PUBLISH_PRODUCT_CONCRETE_IMAGE;
    }
}
