<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductCategoryFilterStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ProductCategoryFilterStorage\ProductCategoryFilterStorageConfig as SprykerProductCategoryFilterStorageConfig;

class ProductCategoryFilterStorageConfig extends SprykerProductCategoryFilterStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductCategoryFilterSynchronizationPoolName(): ?string
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
