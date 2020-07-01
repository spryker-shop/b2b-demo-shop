<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Monitoring;

use Pyz\Yves\Monitoring\Plugin\ControllerListener;
use Spryker\Yves\Monitoring\MonitoringFactory as SprykerMonitoringFactory;
use Spryker\Yves\Monitoring\Plugin\ControllerListener as SprykerControllerListener;

/**
 * @method \Spryker\Yves\Monitoring\MonitoringConfig getConfig()
 */
class MonitoringFactory extends SprykerMonitoringFactory
{
    /**
     * @return \Spryker\Yves\Monitoring\Plugin\ControllerListener
     */
    public function createControllerListener(): SprykerControllerListener
    {
        return new ControllerListener(
            $this->getMonitoringService(),
            $this->getSystem(),
            $this->getConfig()->getIgnorableTransactionRouteNames()
        );
    }
}
