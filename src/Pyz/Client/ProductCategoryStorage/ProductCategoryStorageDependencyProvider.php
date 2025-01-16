<?php



declare(strict_types = 1);

namespace Pyz\Client\ProductCategoryStorage;

use Spryker\Client\CategoryStorage\Plugin\ProductCategoryStorage\ParentCategoryIdsProductAbstractCategoryStorageCollectionExpanderPlugin;
use Spryker\Client\ProductCategoryStorage\ProductCategoryStorageDependencyProvider as SprykerProductCategoryStorageDependencyProvider;

class ProductCategoryStorageDependencyProvider extends SprykerProductCategoryStorageDependencyProvider
{
    /**
     * @return list<\Spryker\Client\ProductCategoryStorageExtension\Dependency\Plugin\ProductAbstractCategoryStorageCollectionExpanderPluginInterface>
     */
    protected function getProductAbstractCategoryStorageCollectionExpanderPlugins(): array
    {
        return [
            new ParentCategoryIdsProductAbstractCategoryStorageCollectionExpanderPlugin(),
        ];
    }
}
