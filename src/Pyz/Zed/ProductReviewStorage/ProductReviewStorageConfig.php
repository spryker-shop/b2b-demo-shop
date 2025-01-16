<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductReviewStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ProductReviewStorage\ProductReviewStorageConfig as SprykerProductReviewStorageConfig;

class ProductReviewStorageConfig extends SprykerProductReviewStorageConfig
{
    /**
     * @return string|null
     */
    public function getProductAbstractReviewSynchronizationPoolName(): ?string
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
