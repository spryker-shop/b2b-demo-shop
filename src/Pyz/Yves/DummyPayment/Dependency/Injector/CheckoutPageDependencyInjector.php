<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DummyPayment\Dependency\Injector;

use Spryker\Shared\Kernel\ContainerInterface;
use Spryker\Yves\Checkout\CheckoutDependencyProvider;
use Spryker\Yves\DummyPayment\Dependency\Injector\CheckoutPageDependencyInjector as SprykerCheckoutPageDependencyInjector;
use Spryker\Yves\DummyPayment\Plugin\DummyPaymentInvoiceSubFormPlugin;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;

class CheckoutPageDependencyInjector extends SprykerCheckoutPageDependencyInjector
{
    /**
     * @param \Spryker\Shared\Kernel\ContainerInterface $container
     *
     * @return \Spryker\Shared\Kernel\ContainerInterface
     */
    protected function injectPaymentSubForms(ContainerInterface $container): ContainerInterface
    {
        $container->extend(CheckoutDependencyProvider::PAYMENT_SUB_FORMS, function (SubFormPluginCollection $paymentSubForms) {
            $paymentSubForms->add(new DummyPaymentInvoiceSubFormPlugin());

            return $paymentSubForms;
        });

        return $container;
    }
}
