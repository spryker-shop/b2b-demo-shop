<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductSetStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ProductSetStorage\ProductSetStorageConfig as SprykerProductSetStorageConfig;

class ProductSetStorageConfig extends SprykerProductSetStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductSetSynchronizationPoolName(): ?string
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
