<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\SalesOrderThresholdGui;

use Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\FormExpander\GlobalHardMaximumThresholdFormExpanderPlugin;
use Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\FormExpander\GlobalHardThresholdFormExpanderPlugin;
use Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\FormExpander\GlobalSoftThresholdFixedFeeFormExpanderPlugin;
use Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\FormExpander\GlobalSoftThresholdFlexibleFeeFormExpanderPlugin;
use Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\FormExpander\GlobalSoftThresholdWithMessageFormExpanderPlugin;
use Spryker\Zed\SalesOrderThresholdGui\SalesOrderThresholdGuiDependencyProvider as SprykerSalesOrderThresholdGuiDependencyProvider;

class SalesOrderThresholdGuiDependencyProvider extends SprykerSalesOrderThresholdGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\SalesOrderThresholdGuiExtension\Dependency\Plugin\SalesOrderThresholdFormExpanderPluginInterface>
     */
    protected function getSalesOrderThresholdFormExpanderPlugins(): array
    {
        return [
            new GlobalHardThresholdFormExpanderPlugin(),
            new GlobalSoftThresholdWithMessageFormExpanderPlugin(),
            new GlobalSoftThresholdFixedFeeFormExpanderPlugin(),
            new GlobalSoftThresholdFlexibleFeeFormExpanderPlugin(),
            new GlobalHardMaximumThresholdFormExpanderPlugin(),
        ];
    }
}
