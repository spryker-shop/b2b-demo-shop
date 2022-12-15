<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PriceProductStorage;

use Spryker\Client\PriceProductMerchantRelationshipStorage\Plugin\PriceProductStorageExtension\PriceProductMerchantRelationshipStorageDimensionPlugin;
use Spryker\Client\PriceProductStorage\PriceProductStorageDependencyProvider as SprykerPriceProductStorageDependencyProvider;
use Spryker\Client\PriceProductVolume\Plugin\PriceProductStorageExtension\PriceProductVolumeExtractorPlugin;
use Spryker\Client\ProductConfigurationStorage\Plugin\PriceProductStorage\ProductConfigurationPriceProductFilterExpanderPlugin;
use Spryker\Client\ProductConfigurationStorage\Plugin\PriceProductStorage\ProductConfigurationStoragePriceDimensionPlugin;

class PriceProductStorageDependencyProvider extends SprykerPriceProductStorageDependencyProvider
{
    /**
     * @return list<\Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePriceDimensionPluginInterface>
     */
    public function getPriceDimensionStorageReaderPlugins(): array
    {
        return [
            new PriceProductMerchantRelationshipStorageDimensionPlugin(),
            new ProductConfigurationStoragePriceDimensionPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePricesExtractorPluginInterface>
     */
    protected function getPriceProductPricesExtractorPlugins(): array
    {
        return [
            new PriceProductVolumeExtractorPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductFilterExpanderPluginInterface>
     */
    protected function getPriceProductFilterExpanderPlugins(): array
    {
        return [
            new ProductConfigurationPriceProductFilterExpanderPlugin(),
        ];
    }
}
