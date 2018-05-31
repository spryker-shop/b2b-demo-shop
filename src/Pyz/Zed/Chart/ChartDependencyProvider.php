<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Chart;

use Spryker\Zed\Chart\ChartDependencyProvider as SprykerChartDependencyProvider;
use Spryker\Zed\ChartOrder\Communication\Plugin\CountOrderChartPlugin;
use Spryker\Zed\ChartOrder\Communication\Plugin\StatusOrderChartPlugin;

class ChartDependencyProvider extends SprykerChartDependencyProvider
{
     /**
      * @return \Spryker\Shared\Chart\Dependency\Plugin\ChartPluginInterface[]
      */
    protected function getChartPlugins(): array
    {
        return [
            new CountOrderChartPlugin(),
            new StatusOrderChartPlugin(),
        ];
    }
}
