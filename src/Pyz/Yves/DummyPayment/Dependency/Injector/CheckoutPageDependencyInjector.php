<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\DummyPayment\Dependency\Injector;

use Spryker\Shared\Kernel\ContainerInterface;
use Spryker\Yves\Checkout\CheckoutDependencyProvider;
use Spryker\Yves\DummyPayment\Plugin\DummyPaymentInvoiceSubFormPlugin;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;
use Spryker\Yves\DummyPayment\Dependency\Injector\CheckoutPageDependencyInjector as SprykerCheckoutPageDependencyInjector;

class CheckoutPageDependencyInjector extends SprykerCheckoutPageDependencyInjector
{
    /**
     * @param \Spryker\Shared\Kernel\ContainerInterface $container
     *
     * @return \Spryker\Shared\Kernel\ContainerInterface
     */
    protected function injectPaymentSubForms(ContainerInterface $container)
    {
        $container->extend(CheckoutDependencyProvider::PAYMENT_SUB_FORMS, function (SubFormPluginCollection $paymentSubForms) {
            $paymentSubForms->add(new DummyPaymentInvoiceSubFormPlugin());

            return $paymentSubForms;
        });

        return $container;
    }
}
