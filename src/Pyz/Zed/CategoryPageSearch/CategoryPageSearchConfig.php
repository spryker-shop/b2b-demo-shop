<?php



declare(strict_types = 1);

namespace Pyz\Zed\CategoryPageSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\CategoryPageSearch\CategoryPageSearchConfig as SprykerCategoryPageSearchConfig;

class CategoryPageSearchConfig extends SprykerCategoryPageSearchConfig
{
    /**
     * @return string
     */
    public function getCategoryPageSynchronizationPoolName(): string
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
