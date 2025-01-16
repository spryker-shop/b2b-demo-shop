<?php



declare(strict_types = 1);

namespace Pyz\Glue\ProductPricesRestApi;

use Spryker\Glue\PriceProductVolumesRestApi\Plugin\ProductPriceRestApi\PriceProductVolumeRestProductPricesAttributesMapperPlugin;
use Spryker\Glue\ProductPricesRestApi\ProductPricesRestApiDependencyProvider as SprykerProductPricesRestApiDependencyProvider;

class ProductPricesRestApiDependencyProvider extends SprykerProductPricesRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\ProductPricesRestApiExtension\Dependency\Plugin\RestProductPricesAttributesMapperPluginInterface>
     */
    protected function getRestProductPricesAttributesMapperPlugins(): array
    {
        return [
            new PriceProductVolumeRestProductPricesAttributesMapperPlugin(),
        ];
    }
}
