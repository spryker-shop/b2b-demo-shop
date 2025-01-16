<?php



declare(strict_types = 1);

namespace Pyz\Yves\ProductConfigurationCartWidget;

use SprykerShop\Yves\DateTimeConfiguratorPageExample\Plugin\ProductConfigurationCartWidget\ExampleDateTimeCartProductConfigurationRenderStrategyPlugin;
use SprykerShop\Yves\ProductConfigurationCartWidget\ProductConfigurationCartWidgetDependencyProvider as SprykerProductConfigurationCartWidgetDependencyProvider;

class ProductConfigurationCartWidgetDependencyProvider extends SprykerProductConfigurationCartWidgetDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\ProductConfigurationCartWidgetExtension\Dependency\Plugin\CartProductConfigurationRenderStrategyPluginInterface>
     */
    protected function getCartProductConfigurationRenderStrategyPlugins(): array
    {
        return [
            new ExampleDateTimeCartProductConfigurationRenderStrategyPlugin(),
        ];
    }
}
