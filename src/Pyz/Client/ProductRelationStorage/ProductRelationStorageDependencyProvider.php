<?php



declare(strict_types = 1);

namespace Pyz\Client\ProductRelationStorage;

use Spryker\Client\PriceProductStorage\Plugin\ProductViewPriceExpanderPlugin;
use Spryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use Spryker\Client\ProductRelationStorage\ProductRelationStorageDependencyProvider as SprykerProductRelationStorageDependencyProvider;

class ProductRelationStorageDependencyProvider extends SprykerProductRelationStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface>
     */
    protected function getRelatedProductExpanderPlugins(): array
    {
        return [
            new ProductViewPriceExpanderPlugin(),
            new ProductViewImageExpanderPlugin(),
        ];
    }
}
