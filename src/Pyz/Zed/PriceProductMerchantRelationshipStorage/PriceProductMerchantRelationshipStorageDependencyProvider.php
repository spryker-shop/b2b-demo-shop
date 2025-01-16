<?php



declare(strict_types = 1);

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
