<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Dashboard;

use Spryker\Zed\ChartOrder\Communication\Plugin\CountOrderChartPlugin;
use Spryker\Zed\ChartOrder\Communication\Plugin\StatusOrderChartPlugin;
use Spryker\Zed\Dashboard\DashboardDependencyProvider as SprykerDashboardDependencyProvider;

class DashboardDependencyProvider extends SprykerDashboardDependencyProvider
{
    /**
     * @return \Spryker\Shared\Chart\Dependency\Plugin\ChartPluginInterface[]
     */
    protected function getPluginChartNames(): array
    {
        return [
            new CountOrderChartPlugin(),
            new StatusOrderChartPlugin(),
        ];
    }
}
