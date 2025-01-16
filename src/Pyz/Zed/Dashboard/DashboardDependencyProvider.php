<?php



declare(strict_types = 1);

namespace Pyz\Zed\Dashboard;

use Spryker\Zed\Dashboard\DashboardDependencyProvider as SprykerDashboardDependencyProvider;
use Spryker\Zed\SalesStatistics\Communication\Plugin\CountOrderChartPlugin;
use Spryker\Zed\SalesStatistics\Communication\Plugin\StatusOrderChartPlugin;
use Spryker\Zed\SalesStatistics\Communication\Plugin\TopOrdersChartPlugin;

class DashboardDependencyProvider extends SprykerDashboardDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\Dashboard\Dependency\Plugin\DashboardPluginInterface>
     */
    protected function getDashboardPlugins(): array
    {
        return [
            new CountOrderChartPlugin(),
            new StatusOrderChartPlugin(),
            new TopOrdersChartPlugin(),
        ];
    }
}
