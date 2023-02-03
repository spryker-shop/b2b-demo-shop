<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Oms;

use Pyz\Zed\Oms\Communication\Plugin\Oms\InitiationTimeoutProcessorPlugin;
use Spryker\Zed\Availability\Communication\Plugin\Oms\AvailabilityReservationPostSaveTerminationAwareStrategyPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\SendOrderConfirmationPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\SendOrderShippedPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandCollectionInterface;
use Spryker\Zed\Oms\OmsDependencyProvider as SprykerOmsDependencyProvider;
use Spryker\Zed\ProductBundle\Communication\Plugin\Oms\ProductBundleReservationPostSaveTerminationAwareStrategyPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Oms\ProductPackagingUnitOmsReservationAggregationPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Reservation\LeadProductReservationPostSaveTerminationAwareStrategyPlugin;
use Spryker\Zed\SalesInvoice\Communication\Plugin\Oms\GenerateOrderInvoiceCommandPlugin;
use Spryker\Zed\SalesPayment\Communication\Plugin\Oms\SendEventPaymentCancelReservationPendingPlugin;
use Spryker\Zed\SalesPayment\Communication\Plugin\Oms\SendEventPaymentConfirmationPendingPlugin;
use Spryker\Zed\SalesPayment\Communication\Plugin\Oms\SendEventPaymentRefundPendingPlugin;
use Spryker\Zed\SalesReturn\Communication\Plugin\Oms\Command\StartReturnCommandPlugin;
use Spryker\Zed\Shipment\Dependency\Plugin\Oms\ShipmentManualEventGrouperPlugin;
use Spryker\Zed\Shipment\Dependency\Plugin\Oms\ShipmentOrderMailExpanderPlugin;

class OmsDependencyProvider extends SprykerOmsDependencyProvider
{
    /**
     * @var string
     */
    public const PYZ_FACADE_TRANSLATOR = 'PYZ_FACADE_TRANSLATOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container->extend(self::COMMAND_PLUGINS, function (CommandCollectionInterface $commandCollection) {
            $commandCollection->add(new SendOrderConfirmationPlugin(), 'Oms/SendOrderConfirmation');
            $commandCollection->add(new SendOrderShippedPlugin(), 'Oms/SendOrderShipped');
            $commandCollection->add(new StartReturnCommandPlugin(), 'Return/StartReturn');
            $commandCollection->add(new GenerateOrderInvoiceCommandPlugin(), 'Invoice/Generate');
            $commandCollection->add(new SendEventPaymentConfirmationPendingPlugin(), 'Payment/SendEventPaymentConfirmationPending');
            $commandCollection->add(new SendEventPaymentRefundPendingPlugin(), 'Payment/SendEventPaymentRefundPending');
            $commandCollection->add(new SendEventPaymentCancelReservationPendingPlugin(), 'Payment/SendEventPaymentCancelReservationPending');

            return $commandCollection;
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Zed\OmsExtension\Dependency\Plugin\ReservationPostSaveTerminationAwareStrategyPluginInterface>
     */
    protected function getReservationPostSaveTerminationAwareStrategyPlugins(): array
    {
        return [
            new AvailabilityReservationPostSaveTerminationAwareStrategyPlugin(),
            new ProductBundleReservationPostSaveTerminationAwareStrategyPlugin(),
            new LeadProductReservationPostSaveTerminationAwareStrategyPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface>
     */
    protected function getOmsOrderMailExpanderPlugins(Container $container): array
    {
        return [
            new ShipmentOrderMailExpanderPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\OmsExtension\Dependency\Plugin\OmsManualEventGrouperPluginInterface>
     */
    protected function getOmsManualEventGrouperPlugins(Container $container): array
    {
        return [
            new ShipmentManualEventGrouperPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\OmsExtension\Dependency\Plugin\OmsReservationAggregationPluginInterface>
     */
    protected function getOmsReservationAggregationPlugins(): array
    {
        return [
            new ProductPackagingUnitOmsReservationAggregationPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addPyzTranslatorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPyzTranslatorFacade(Container $container): Container
    {
        $container->set(static::PYZ_FACADE_TRANSLATOR, function (Container $container) {
            return $container->getLocator()->translator()->facade();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Zed\OmsExtension\Dependency\Plugin\TimeoutProcessorPluginInterface>
     */
    protected function getTimeoutProcessorPlugins(): array
    {
        return [
            new InitiationTimeoutProcessorPlugin(),
        ];
    }
}
