<?php

namespace Pyz\Zed\ProductStorage;

use Spryker\Zed\ProductStorage\ProductStorageDependencyProvider as SprykerProductStorageDependencyProvider;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductStorage\ProductTypeProductConcreteStorageCollectionExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductStorage\ShipmentTypeProductConcreteStorageCollectionExpanderPlugin;

class ProductStorageDependencyProvider extends SprykerProductStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductStorageExtension\Dependency\Plugin\ProductConcreteStorageCollectionExpanderPluginInterface>
     */
    protected function getProductConcreteStorageCollectionExpanderPlugins(): array
    {
        return [
            new ShipmentTypeProductConcreteStorageCollectionExpanderPlugin(),
            new ProductTypeProductConcreteStorageCollectionExpanderPlugin(),
        ];
    }
}
