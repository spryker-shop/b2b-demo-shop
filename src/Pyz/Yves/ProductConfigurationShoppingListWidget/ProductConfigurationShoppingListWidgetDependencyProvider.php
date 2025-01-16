<?php



declare(strict_types = 1);

namespace Pyz\Yves\ProductConfigurationShoppingListWidget;

use SprykerShop\Yves\DateTimeConfiguratorPageExample\Plugin\ProductConfigurationShoppingListWidget\ExampleDateTimeShoppingListItemProductConfigurationRenderStrategyPlugin;
use SprykerShop\Yves\ProductConfigurationShoppingListWidget\ProductConfigurationShoppingListWidgetDependencyProvider as SprykerProductConfigurationShoppingListWidgetDependencyProvider;

class ProductConfigurationShoppingListWidgetDependencyProvider extends SprykerProductConfigurationShoppingListWidgetDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\ProductConfigurationShoppingListWidgetExtension\Dependency\Plugin\ShoppingListItemProductConfigurationRenderStrategyPluginInterface>
     */
    protected function getShoppingListItemProductConfigurationRenderStrategyPlugins(): array
    {
        return [
            new ExampleDateTimeShoppingListItemProductConfigurationRenderStrategyPlugin(),
        ];
    }
}
