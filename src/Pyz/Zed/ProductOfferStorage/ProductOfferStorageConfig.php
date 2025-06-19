<?php

namespace Pyz\Zed\ProductOfferStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ProductOfferStorage\ProductOfferStorageConfig as SprykerProductOfferStorageConfig;

class ProductOfferStorageConfig extends SprykerProductOfferStorageConfig
{
    public function getProductOfferSynchronizationPoolName(): ?string
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
