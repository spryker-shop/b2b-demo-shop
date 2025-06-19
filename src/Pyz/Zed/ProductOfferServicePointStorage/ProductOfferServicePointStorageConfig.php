<?php

namespace Pyz\Zed\ProductOfferServicePointStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ProductOfferServicePointStorage\ProductOfferServicePointStorageConfig as SprykerProductOfferServicePointStorageConfig;

class ProductOfferServicePointStorageConfig extends SprykerProductOfferServicePointStorageConfig
{
    public function getProductOfferServiceSynchronizationPoolName(): ?string
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
