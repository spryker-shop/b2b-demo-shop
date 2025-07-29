<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ChartGui;

use Pyz\Zed\ExampleChart\Plugin\ExampleChart;
use Spryker\Zed\ChartGui\ChartGuiDependencyProvider as SprykerChartGuiDependencyProvider;
use Spryker\Zed\ChartGui\Communication\Plugin\Twig\Chart\BarChartTwigPlugin;
use Spryker\Zed\ChartGui\Communication\Plugin\Twig\Chart\ChartTwigPlugin;
use Spryker\Zed\ChartGui\Communication\Plugin\Twig\Chart\LineChartTwigPlugin;
use Spryker\Zed\ChartGui\Communication\Plugin\Twig\Chart\PieChartTwigPlugin;
use Spryker\Zed\SalesStatistics\Communication\Plugin\CountOrderChartPlugin;
use Spryker\Zed\SalesStatistics\Communication\Plugin\StatusOrderChartPlugin;
use Spryker\Zed\SalesStatistics\Communication\Plugin\TopOrdersChartPlugin;

class ChartGuiDependencyProvider extends SprykerChartGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\Chart\Dependency\Plugin\ChartPluginInterface>
     */
    protected function getChartPlugins(): array
    {
        return [
            new CountOrderChartPlugin(),
            new StatusOrderChartPlugin(),
            new TopOrdersChartPlugin(),
            new ExampleChart(),
        ];
    }

    /**
     * @return array<\Spryker\Shared\Chart\Dependency\Plugin\TwigChartFunctionPluginInterface>
     */
    protected function getTwigChartFunctionPlugins(): array
    {
        return [
            new BarChartTwigPlugin(),
            new ChartTwigPlugin(),
            new LineChartTwigPlugin(),
            new PieChartTwigPlugin(),
        ];
    }
}
