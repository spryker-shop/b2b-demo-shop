<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ProductStorage;

use Spryker\Client\AvailabilityStorage\Plugin\ProductViewAvailabilityStorageExpanderPlugin;
use Spryker\Client\PriceProductStorage\Plugin\ProductViewPriceExpanderPlugin;
use Spryker\Client\ProductDiscontinuedStorage\Plugin\ProductStorage\ProductDiscontinuedProductAvailabilityExpanderPlugin;
use Spryker\Client\ProductDiscontinuedStorage\Plugin\ProductStorage\ProductViewDiscontinuedOptionsExpanderPlugin;
use Spryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use Spryker\Client\ProductListStorage\Plugin\ProductStorageExtension\ProductAbstractRestrictionPlugin;
use Spryker\Client\ProductListStorage\Plugin\ProductStorageExtension\ProductConcreteRestrictionPlugin;
use Spryker\Client\ProductListStorage\Plugin\ProductStorageExtension\ProductViewVariantRestrictionPlugin;
use Spryker\Client\ProductStorage\Plugin\ProductViewVariantExpanderPlugin;
use Spryker\Client\ProductStorage\ProductStorageDependencyProvider as SprykerProductStorageDependencyProvider;

class ProductStorageDependencyProvider extends SprykerProductStorageDependencyProvider
{
    /**
     * @return \Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface[]
     */
    protected function getProductViewExpanderPlugins()
    {
        return [
            new ProductViewDiscontinuedOptionsExpanderPlugin(), #ProductDiscontinuedFeature
            new ProductViewVariantExpanderPlugin(),
            new ProductViewVariantRestrictionPlugin(), # Should be included after ProductViewVariantExpanderPlugin
            new ProductViewPriceExpanderPlugin(),
            new ProductViewAvailabilityStorageExpanderPlugin(),
            new ProductDiscontinuedProductAvailabilityExpanderPlugin(), #ProductDiscontinuedFeature
            new ProductViewImageExpanderPlugin(),
        ];
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
}
