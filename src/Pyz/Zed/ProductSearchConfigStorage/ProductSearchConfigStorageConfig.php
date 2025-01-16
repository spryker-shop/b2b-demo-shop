<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductSearchConfigStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ProductSearchConfigStorage\ProductSearchConfigStorageConfig as SprykerProductSearchConfigStorageConfig;

class ProductSearchConfigStorageConfig extends SprykerProductSearchConfigStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductSearchConfigSynchronizationPoolName(): ?string
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
