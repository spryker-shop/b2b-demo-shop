<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PriceProductStorage;

use Spryker\Client\PriceProductMerchantRelationshipStorage\Plugin\PriceProductStorageExtension\PriceProductMerchantRelationshipStorageDimensionPlugin;
use Spryker\Client\PriceProductStorage\PriceProductStorageDependencyProvider as SprykerPriceProductStorageDependencyProvider;
use Spryker\Client\PriceProductVolume\Plugin\PriceProductStorageExtension\PriceProductVolumeExtractorPlugin;

class PriceProductStorageDependencyProvider extends SprykerPriceProductStorageDependencyProvider
{
    /**
     * @return \Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePriceDimensionPluginInterface[]
     */
    public function getPriceDimensionStorageReaderPlugins(): array
    {
        return [
            new PriceProductMerchantRelationshipStorageDimensionPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePricesExtractorPluginInterface[]
     */
    protected function getPriceProductPricesExtractorPlugins(): array
    {
        return [
            new PriceProductVolumeExtractorPlugin(),
        ];
    }
}
