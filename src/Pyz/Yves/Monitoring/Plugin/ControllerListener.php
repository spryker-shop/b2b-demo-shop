<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\Monitoring\Plugin;

use Spryker\Service\Monitoring\MonitoringServiceInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\Monitoring\Dependency\Service\MonitoringToUtilNetworkServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @method \Spryker\Yves\Monitoring\MonitoringFactory getFactory()
 */
class ControllerListener extends AbstractPlugin implements EventSubscriberInterface
{
    const PRIORITY = -255;

    /**
     * @var \Spryker\Service\Monitoring\MonitoringServiceInterface
     */
    protected $monitoringService;

    /**
     * @var \Spryker\Yves\Monitoring\Dependency\Service\MonitoringToUtilNetworkServiceInterface
     */
    protected $utilNetworkService;

    /**
     * @var array
     */
    protected $ignorableTransactions;

    /**
     * @param \Spryker\Service\Monitoring\MonitoringServiceInterface $monitoringService
     * @param \Spryker\Yves\Monitoring\Dependency\Service\MonitoringToUtilNetworkServiceInterface $utilNetworkService
     * @param array $ignorableTransactions
     */
    public function __construct(MonitoringServiceInterface $monitoringService, MonitoringToUtilNetworkServiceInterface $utilNetworkService, array $ignorableTransactions = [])
    {
        $this->monitoringService = $monitoringService;
        $this->utilNetworkService = $utilNetworkService;
        $this->ignorableTransactions = $ignorableTransactions;
    }

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

    /**
     * @param string $transaction
     *
     * @return bool
     */
    protected function isTransactionIgnorable(string $transaction): bool
    {
        foreach ($this->ignorableTransactions as $ignorableTransaction) {
            if (strpos($transaction, $ignorableTransaction) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => ['onKernelController', static::PRIORITY],
        ];
    }
}
