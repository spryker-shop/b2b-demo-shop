<?php



declare(strict_types = 1);

namespace Pyz\Yves\ChartWidget;

use Pyz\Yves\ExampleChart\Plugin\ExampleChartPlugin;
use SprykerShop\Yves\ChartWidget\ChartWidgetDependencyProvider as SprykerShopChartDependencyProvider;

class ChartWidgetDependencyProvider extends SprykerShopChartDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\Chart\Dependency\Plugin\ChartPluginInterface>
     */
    protected function getChartPlugins(): array
    {
        return [
            new ExampleChartPlugin(),
        ];
    }
}
