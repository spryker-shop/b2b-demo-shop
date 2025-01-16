<?php



declare(strict_types = 1);

namespace Pyz\Yves\SalesProductConfigurationWidget;

use SprykerShop\Yves\DateTimeConfiguratorPageExample\Plugin\SalesProductConfigurationWidget\ExampleDateTimeSalesProductConfigurationRenderStrategyPlugin;
use SprykerShop\Yves\SalesProductConfigurationWidget\SalesProductConfigurationWidgetDependencyProvider as SprykerSalesProductConfigurationWidgetDependencyProvider;

class SalesProductConfigurationWidgetDependencyProvider extends SprykerSalesProductConfigurationWidgetDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\SalesProductConfigurationWidgetExtension\Dependency\Plugin\SalesProductConfigurationRenderStrategyPluginInterface>
     */
    protected function getSalesProductConfigurationRenderStrategyPlugins(): array
    {
        return [
            new ExampleDateTimeSalesProductConfigurationRenderStrategyPlugin(),
        ];
    }
}
