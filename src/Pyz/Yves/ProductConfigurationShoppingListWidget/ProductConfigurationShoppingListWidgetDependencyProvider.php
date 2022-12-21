<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
