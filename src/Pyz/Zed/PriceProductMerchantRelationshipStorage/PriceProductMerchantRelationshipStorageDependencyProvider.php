<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PriceProductMerchantRelationshipStorage;

use Spryker\Zed\Merchant\Communication\Plugin\PriceProductMerchantRelationshipStorage\MerchantPriceProductMerchantRelationshipStorageFilterPlugin;
use Spryker\Zed\PriceProductMerchantRelationshipStorage\PriceProductMerchantRelationshipStorageDependencyProvider as SprykerPriceProductMerchantRelationshipStorageDependencyProvider;

class PriceProductMerchantRelationshipStorageDependencyProvider extends SprykerPriceProductMerchantRelationshipStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\PriceProductMerchantRelationshipStorageExtension\Dependency\Plugin\PriceProductMerchantRelationshipStorageFilterPluginInterface>
     */
    protected function getPriceProductMerchantRelationshipStorageFilterPlugins(): array
    {
        return [
            new MerchantPriceProductMerchantRelationshipStorageFilterPlugin(),
        ];
    }
}
