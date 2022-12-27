<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ProductStorage;

use Spryker\Client\AvailabilityStorage\Plugin\ProductViewAvailabilityStorageExpanderPlugin;
use Spryker\Client\MerchantProductOfferStorage\Plugin\ProductStorage\ProductViewProductOfferExpanderPlugin;
use Spryker\Client\PriceProductStorage\Plugin\ProductViewPriceExpanderPlugin;
use Spryker\Client\ProductDiscontinuedStorage\Plugin\ProductStorage\ProductDiscontinuedProductAvailabilityExpanderPlugin;
use Spryker\Client\ProductDiscontinuedStorage\Plugin\ProductStorage\ProductViewDiscontinuedOptionsExpanderPlugin;
use Spryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use Spryker\Client\ProductListStorage\Plugin\ProductStorageExtension\ProductAbstractListStorageRestrictionFilterPlugin;
use Spryker\Client\ProductListStorage\Plugin\ProductStorageExtension\ProductAbstractRestrictionPlugin;
use Spryker\Client\ProductListStorage\Plugin\ProductStorageExtension\ProductConcreteListStorageRestrictionFilterPlugin;
use Spryker\Client\ProductListStorage\Plugin\ProductStorageExtension\ProductConcreteRestrictionPlugin;
use Spryker\Client\ProductStorage\Plugin\ProductVariantProductViewExpanderPlugin;
use Spryker\Client\ProductStorage\ProductStorageDependencyProvider as SprykerProductStorageDependencyProvider;

class ProductStorageDependencyProvider extends SprykerProductStorageDependencyProvider
{
    /**
     * @return \Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface[]
     */
    protected function getProductViewExpanderPlugins()
    {
        /** @var \Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface[] $plugins */
        $plugins = [
            new ProductViewDiscontinuedOptionsExpanderPlugin(), #ProductDiscontinuedFeature
            new ProductVariantProductViewExpanderPlugin(),
            new ProductViewPriceExpanderPlugin(),
            new ProductViewAvailabilityStorageExpanderPlugin(),
            new ProductDiscontinuedProductAvailabilityExpanderPlugin(), #ProductDiscontinuedFeature
            new ProductViewImageExpanderPlugin(),
            new ProductViewProductOfferExpanderPlugin(),
        ];

        return $plugins;
    }

    /**
     * @return \Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductAbstractRestrictionPluginInterface[]
     */
    protected function getProductAbstractRestrictionPlugins(): array
    {
        return [
            new ProductAbstractRestrictionPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductConcreteRestrictionPluginInterface[]
     */
    protected function getProductConcreteRestrictionPlugins(): array
    {
        return [
            new ProductConcreteRestrictionPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductAbstractRestrictionFilterPluginInterface[]
     */
    protected function getProductAbstractRestrictionFilterPlugins(): array
    {
        return [
            new ProductAbstractListStorageRestrictionFilterPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductConcreteRestrictionFilterPluginInterface[]
     */
    protected function getProductConcreteRestrictionFilterPlugins(): array
    {
        return [
            new ProductConcreteListStorageRestrictionFilterPlugin(),
        ];
    }
}
