<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Checkout;

use Spryker\Zed\Availability\Communication\Plugin\ProductsAvailableCheckoutPreConditionPlugin;
use Spryker\Zed\CartNote\Communication\Plugin\Checkout\CartNoteSaverPlugin;
use Spryker\Zed\Checkout\CheckoutDependencyProvider as SprykerCheckoutDependencyProvider;
use Spryker\Zed\Customer\Communication\Plugin\Checkout\CustomerOrderSavePlugin;
use Spryker\Zed\Customer\Communication\Plugin\CustomerPreConditionCheckerPlugin;
use Spryker\Zed\Discount\Communication\Plugin\Checkout\DiscountOrderSavePlugin;
use Spryker\Zed\Discount\Communication\Plugin\Checkout\VoucherDiscountMaxUsageCheckoutPreConditionPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentMethodValidityCheckoutPreConditionPlugin;
use Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentOrderSaverPlugin;
use Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentPostCheckPlugin;
use Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentPreCheckPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Checkout\ProductBundleAvailabilityCheckoutPreConditionPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Checkout\ProductBundleOrderSaverPlugin;
use Spryker\Zed\ProductDiscontinued\Communication\Plugin\Checkout\ProductDiscontinuedCheckoutPreConditionPlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\Checkout\ProductOptionOrderSaverPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Checkout\AmountAvailabilityCheckoutPreConditionPlugin;
use Spryker\Zed\QuoteApproval\Communication\Plugin\Checkout\QuoteApprovalCheckoutPreConditionPlugin;
use Spryker\Zed\QuoteRequest\Communication\Plugin\Checkout\CloseQuoteRequestCheckoutPostSaveHookPlugin;
use Spryker\Zed\QuoteRequest\Communication\Plugin\Checkout\QuoteRequestPreCheckPlugin;
use Spryker\Zed\Sales\Communication\Plugin\Checkout\SalesOrderSaverPlugin;
use Spryker\Zed\Sales\Communication\Plugin\SalesOrderExpanderPlugin;
use Spryker\Zed\SalesOrderThreshold\Communication\Plugin\Checkout\SalesOrderThresholdCheckoutPreConditionPlugin;
use Spryker\Zed\SalesOrderThreshold\Communication\Plugin\Checkout\SalesOrderThresholdExpenseSavePlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\Checkout\ItemMetadataSaverPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\Checkout\OrderShipmentSavePlugin;
use Spryker\Zed\ShipmentCheckoutConnector\Communication\Plugin\Checkout\ShipmentCheckoutPreCheckPlugin;

class CheckoutDependencyProvider extends SprykerCheckoutDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPreConditionPluginInterface[]
     */
    protected function getCheckoutPreConditions(Container $container)
    {
        return [
            new CustomerPreConditionCheckerPlugin(),
            new ProductsAvailableCheckoutPreConditionPlugin(),
            new ProductBundleAvailabilityCheckoutPreConditionPlugin(),
            new PaymentPreCheckPlugin(),
            new ProductDiscontinuedCheckoutPreConditionPlugin(), #ProductDiscontinuedFeature
            new AmountAvailabilityCheckoutPreConditionPlugin(),
            new SalesOrderThresholdCheckoutPreConditionPlugin(), #SalesOrderThresholdFeature
            new VoucherDiscountMaxUsageCheckoutPreConditionPlugin(),
            new QuoteRequestPreCheckPlugin(),
            new QuoteApprovalCheckoutPreConditionPlugin(),
            new ShipmentCheckoutPreCheckPlugin(),
            new PaymentMethodValidityCheckoutPreConditionPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Checkout\Dependency\Plugin\CheckoutSaveOrderInterface[]
     */
    protected function getCheckoutOrderSavers(Container $container)
    {
        /** @var \Spryker\Zed\Checkout\Dependency\Plugin\CheckoutSaveOrderInterface[] $plugins */
        $plugins = [
            new CustomerOrderSavePlugin(),
            new SalesOrderSaverPlugin(),
            new CartNoteSaverPlugin(), #CartNoteFeature
            new ProductOptionOrderSaverPlugin(),
            new ItemMetadataSaverPlugin(),
            new OrderShipmentSavePlugin(),
            new DiscountOrderSavePlugin(),
            new ProductBundleOrderSaverPlugin(),
            new PaymentOrderSaverPlugin(),
            new SalesOrderThresholdExpenseSavePlugin(),
        ];

        return $plugins;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPostSaveHookInterface[]
     */
    protected function getCheckoutPostHooks(Container $container)
    {
        return [
            new PaymentPostCheckPlugin(),
            new CloseQuoteRequestCheckoutPostSaveHookPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreSaveHookInterface[]|\Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreSaveInterface[]
     */
    protected function getCheckoutPreSaveHooks(Container $container)
    {
        return [
            new SalesOrderExpanderPlugin(),
        ];
    }
}
