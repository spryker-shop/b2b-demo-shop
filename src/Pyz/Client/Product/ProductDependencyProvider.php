<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Product;

use Spryker\Client\AvailabilityStorage\Plugin\StorageProductAvailabilityStorageExpanderPlugin;
use Spryker\Client\Product\ProductDependencyProvider as SprykerProductDependencyProvider;
use Spryker\Client\ProductCategory\Plugin\StorageProductCategoryExpanderPlugin;
use Spryker\Client\ProductImage\Plugin\StorageProductImageExpanderPlugin;

class ProductDependencyProvider extends SprykerProductDependencyProvider
{
    /**
     * @return \Spryker\Client\Product\Dependency\Plugin\StorageProductExpanderPluginInterface[]
     */
    protected function getStorageProductExpanderPlugins()
    {
        return [
            new StorageProductCategoryExpanderPlugin(),
            new StorageProductImageExpanderPlugin(),
            new StorageProductAvailabilityStorageExpanderPlugin(),
        ];
    }
}
