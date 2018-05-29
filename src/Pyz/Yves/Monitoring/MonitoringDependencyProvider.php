<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Monitoring;

use Spryker\Yves\Monitoring\MonitoringDependencyProvider as SprykerMonitoringDependencyProvider;
use SprykerEco\Yves\NewRelic\Plugin\NewRelicMonitoringExtensionPlugin;
use SprykerEco\Yves\Tideways\Plugin\TidewaysMonitoringExtensionPlugin;

class MonitoringDependencyProvider extends SprykerMonitoringDependencyProvider
{
    /**
     * @return \Spryker\Yves\MonitoringExtension\Dependency\Plugin\MonitoringExtensionPluginInterface[]
     */
    protected function getMonitoringPlugins(): array
    {
        return [
            new TidewaysMonitoringExtensionPlugin(),
            new NewRelicMonitoringExtensionPlugin(),
        ];
    }
}
