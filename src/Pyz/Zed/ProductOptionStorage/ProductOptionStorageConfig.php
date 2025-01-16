<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductOptionStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ProductOptionStorage\ProductOptionStorageConfig as SprykerProductOptionStorageConfig;

class ProductOptionStorageConfig extends SprykerProductOptionStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductAbstractOptionSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return string|null
     */
    public function getEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }
}
