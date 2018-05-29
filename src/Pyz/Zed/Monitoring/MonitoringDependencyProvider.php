<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Monitoring;

use Spryker\Zed\Monitoring\MonitoringDependencyProvider as SprykerMonitoringDependencyProvider;
use SprykerEco\Zed\NewRelic\Communication\Plugin\NewRelicMonitoringExtensionPlugin;
use SprykerEco\Zed\Tideways\Communication\Plugin\TidewaysMonitoringExtensionPlugin;

class MonitoringDependencyProvider extends SprykerMonitoringDependencyProvider
{
    /**
     * @return \Spryker\Zed\MonitoringExtension\Dependency\Plugin\MonitoringExtensionPluginInterface[]
     */
    protected function getMonitoringPlugins(): array
    {
        return [
            new TidewaysMonitoringExtensionPlugin(),
            new NewRelicMonitoringExtensionPlugin(),
        ];
    }
}
