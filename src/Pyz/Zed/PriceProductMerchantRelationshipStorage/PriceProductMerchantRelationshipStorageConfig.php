<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\PriceProductMerchantRelationshipStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\PriceProductMerchantRelationshipStorage\PriceProductMerchantRelationshipStorageConfig as SprykerPriceProductMerchantRelationshipStorageConfig;

/**
 * @method \Spryker\Shared\PriceProductMerchantRelationshipStorage\PriceProductMerchantRelationshipStorageConfig getSharedConfig()
 */
class PriceProductMerchantRelationshipStorageConfig extends SprykerPriceProductMerchantRelationshipStorageConfig
{
    public function getPriceProductConcreteMerchantRelationSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    public function getPriceProductAbstractMerchantRelationSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    public function getMerchantRelationEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }

    public function getPriceProductConcreteMerchantRelationEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }

    public function getPriceProductAbstractMerchantRelationEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }
}
