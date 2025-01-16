<?php



declare(strict_types = 1);

namespace Pyz\Glue\ShoppingListsRestApi;

use Spryker\Glue\ProductConfigurationShoppingListsRestApi\Plugin\ShoppingListsRestApi\ProductConfigurationRestShoppingListItemsAttributesMapperPlugin;
use Spryker\Glue\ProductConfigurationShoppingListsRestApi\Plugin\ShoppingListsRestApi\ProductConfigurationShoppingListItemRequestMapperPlugin;
use Spryker\Glue\ShoppingListsRestApi\ShoppingListsRestApiDependencyProvider as SprykerShoppingListsRestApiDependencyProvider;

class ShoppingListsRestApiDependencyProvider extends SprykerShoppingListsRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\ShoppingListsRestApiExtension\Dependency\Plugin\RestShoppingListItemsAttributesMapperPluginInterface>
     */
    protected function getRestShoppingListItemsAttributesMapperPlugins(): array
    {
        return [
            new ProductConfigurationRestShoppingListItemsAttributesMapperPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\ShoppingListsRestApiExtension\Dependency\Plugin\ShoppingListItemRequestMapperPluginInterface>
     */
    protected function getShoppingListItemRequestMapperPlugins(): array
    {
        return [
            new ProductConfigurationShoppingListItemRequestMapperPlugin(),
        ];
    }
}
