<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PriceProductMerchantRelationshipStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\PriceProductMerchantRelationshipStorage\PriceProductMerchantRelationshipStorageConfig as SprykerPriceProductMerchantRelationshipStorageConfig;

/**
 * @method \Spryker\Shared\PriceProductMerchantRelationshipStorage\PriceProductMerchantRelationshipStorageConfig getSharedConfig()
 */
class PriceProductMerchantRelationshipStorageConfig extends SprykerPriceProductMerchantRelationshipStorageConfig
{
    /**
     * @return string|null
     */
    public function getPriceProductConcreteMerchantRelationSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return string|null
     */
    public function getPriceProductAbstractMerchantRelationSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
