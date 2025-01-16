<?php



declare(strict_types = 1);

namespace Pyz\Yves\ProductConfigurationWidget;

use SprykerShop\Yves\DateTimeConfiguratorPageExample\Plugin\ProductConfigurationWidget\ExampleDateTimeProductConfigurationRenderStrategyPlugin;
use SprykerShop\Yves\ProductConfigurationWidget\ProductConfigurationWidgetDependencyProvider as SprykerProductConfigurationWidgetDependencyProvider;

class ProductConfigurationWidgetDependencyProvider extends SprykerProductConfigurationWidgetDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\ProductConfigurationWidgetExtension\Dependency\Plugin\ProductConfigurationRenderStrategyPluginInterface>
     */
    protected function getProductConfigurationRenderStrategyPlugins(): array
    {
        return [
            new ExampleDateTimeProductConfigurationRenderStrategyPlugin(),
        ];
    }
}
