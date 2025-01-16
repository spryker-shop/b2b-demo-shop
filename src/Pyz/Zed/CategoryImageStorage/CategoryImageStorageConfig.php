<?php



declare(strict_types = 1);

namespace Pyz\Zed\CategoryImageStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\CategoryImageStorage\CategoryImageStorageConfig as SprykerCategoryImageStorageConfig;

class CategoryImageStorageConfig extends SprykerCategoryImageStorageConfig
{
    /**
     * @return string|null
     */
    public function getCategoryImageSynchronizationPoolName(): ?string
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
