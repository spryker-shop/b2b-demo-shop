<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\ProductConfigurationShoppingListsRestApi;

use Spryker\Glue\ProductConfigurationShoppingListsRestApi\ProductConfigurationShoppingListsRestApiDependencyProvider as SprykerProductConfigurationShoppingListsRestApiDependencyProvider;
use Spryker\Glue\ProductConfigurationsPriceProductVolumesRestApi\Plugin\ProductConfigurationShoppingListsRestApi\ProductConfigurationVolumePriceProductConfigurationPriceMapperPlugin;
use Spryker\Glue\ProductConfigurationsPriceProductVolumesRestApi\Plugin\ProductConfigurationShoppingListsRestApi\ProductConfigurationVolumePriceRestProductConfigurationPriceMapperPlugin;

class ProductConfigurationShoppingListsRestApiDependencyProvider extends SprykerProductConfigurationShoppingListsRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\ProductConfigurationShoppingListsRestApiExtension\Dependency\Plugin\ProductConfigurationPriceMapperPluginInterface>
     */
    protected function getProductConfigurationPriceMapperPlugins(): array
    {
        return [
            new ProductConfigurationVolumePriceProductConfigurationPriceMapperPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\ProductConfigurationShoppingListsRestApiExtension\Dependency\Plugin\RestProductConfigurationPriceMapperPluginInterface>
     */
    protected function getRestProductConfigurationPriceMapperPlugins(): array
    {
        return [
            new ProductConfigurationVolumePriceRestProductConfigurationPriceMapperPlugin(),
        ];
    }
}
