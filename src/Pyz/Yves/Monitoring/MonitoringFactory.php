<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Monitoring;

use Pyz\Yves\Monitoring\Plugin\ControllerListener;
use Spryker\Service\Monitoring\MonitoringServiceInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use Spryker\Yves\Monitoring\Dependency\Service\MonitoringToUtilNetworkServiceInterface;

/**
 * @method \Spryker\Yves\Monitoring\MonitoringConfig getConfig()
 */
class MonitoringFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Yves\Monitoring\Plugin\ControllerListener
     */
    public function createControllerListener(): ControllerListener
    {
        return new ControllerListener(
            $this->getMonitoringService(),
            $this->getSystem(),
            $this->getConfig()->getIgnorableTransactionRouteNames()
        );
    }

    /**
     * @return \Spryker\Service\Monitoring\MonitoringServiceInterface
     */
    public function getMonitoringService(): MonitoringServiceInterface
    {
        return $this->getProvidedDependency(MonitoringDependencyProvider::MONITORING_SERVICE);
    }

    /**
     * @return \Spryker\Yves\Monitoring\Dependency\Service\MonitoringToUtilNetworkServiceInterface
     */
    public function getSystem(): MonitoringToUtilNetworkServiceInterface
    {
        return $this->getProvidedDependency(MonitoringDependencyProvider::SERVICE_NETWORK);
    }
}
