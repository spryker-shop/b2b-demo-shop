<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Monitoring\Plugin;

use Spryker\Yves\Monitoring\Plugin\ControllerListener as SprykerControllerListener;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * @method \Spryker\Yves\Monitoring\MonitoringFactory getFactory()
 */
class ControllerListener extends SprykerControllerListener
{
    /**
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
     *
     * @return void
     */
    public function onKernelController(FilterControllerEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $transactionName = $request->attributes->get('_route') ?: 'home';
        $requestUri = $request->server->get('REQUEST_URI', 'n/a');
        $host = $request->server->get('COMPUTERNAME', $this->utilNetworkService->getHostName());
        $this->monitoringService->setTransactionName($transactionName);
        $this->monitoringService->addCustomParameter('request_uri', $requestUri);
        $this->monitoringService->addCustomParameter('host', $host);

        if ($this->isTransactionIgnorable($transactionName)) {
            $this->monitoringService->markIgnoreTransaction();
        }
    }
}
